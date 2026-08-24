<?php
namespace App\NumberService\ThirdParty;

use Log;
use App\Helpers\MainHelper;
use App\NumberService\NumberService;

/**
 * Class VoxbeamNumberService
 * 
 * Integration service for Voxbeam Wholesale Telecommunications API.
 * Manages wholesale DID inventory and trunk assignments.
 */
class VoxbeamNumberService extends NumberService 
{
    private $username;
    private $token;
    private $baseUrl = 'https://api.voxbeam.com/v1';

    /**
     * VoxbeamNumberService constructor.
     *
     * @param array|null $serviceData Contains api_key (Username) and api_secret (Token)
     * @param array $config Additional provider settings
     */
    public function __construct($serviceData = NULL, $config = []) 
    {
        if (empty($serviceData) || empty($serviceData['api_key']) || empty($serviceData['api_secret'])) {
            $this->isUsable = false;
            return;
        }

        $this->config = $config;
        $this->username = $serviceData['api_key'];
        $this->token = $serviceData['api_secret'];
        $this->isUsable = true;
    }

    public function getName() 
    {
        return "Voxbeam";
    }

    /**
     * Search available wholesale numbers via Voxbeam API.
     */
    public function listNumbersAPI($country, $region, $prefix = "", $rateCenter = "", $type = "local", $for = "voice", $extras = [])
    {
        $queryParams = [
            'country' => $country,
            'limit' => 50
        ];

        if (!empty($prefix)) {
            $queryParams['prefix'] = $prefix;
        }

        $response = $this->makeRequest('GET', '/dids/available?' . http_build_query($queryParams));

        if (!$response || !isset($response['result']) || $response['status'] !== 'ok') {
            return [];
        }

        $numbers = [];
        foreach ($response['result'] as $item) {
            $attrs = [
                'country' => $country,
                'api_number' => $item['did'],
                'number' => MainHelper::toE164($item['did']),
                'region' => $region,
                'monthly_cost' => $item['monthly_rate'] ?? '0.50',
                'setup_cost' => $item['setup_rate'] ?? '0.50',
                'features' => ['voice'],
                'type' => $type
            ];
            $numbers[] = $this->numberArray($attrs);
        }

        return $numbers;
    }

    /**
     * Registers/orders a DID with Voxbeam.
     */
    public function register($workspace, $type, $number, $region = NULL, $cost = NULL)
    {
        $payload = [
            'did' => MainHelper::toE164($number),
            'pop' => $this->config['pop'] ?? 'us-east'
        ];

        $response = $this->makeRequest('POST', '/dids/order', $payload);

        if (isset($response['status']) && $response['status'] === 'ok') {
            Log::info("Voxbeam DID order successful for: {$number}");
            return true;
        }

        Log::error("Voxbeam DID order failed for: {$number}", ['response' => $response]);
        return false;
    }

    /**
     * Releases a DID back to Voxbeam inventory.
     */
    public function unrent($number)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $response = $this->makeRequest('POST', '/dids/cancel', ['did' => $cleanNumber]);

        if (isset($response['status']) && $response['status'] === 'ok') {
            Log::info("Voxbeam DID cancelled successfully: {$number}");
            return true;
        }

        return false;
    }

    /**
     * Internal cURL executor for Voxbeam API.
     */
    private function makeRequest($method, $endpoint, $payload = null)
    {
        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        $headers = [
            "X-Auth-User: {$this->username}",
            "X-Auth-Token: {$this->token}",
            "Content-Type: application/json"
        ];

        if ($payload) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            return json_decode($result, true);
        }

        return null;
    }
}