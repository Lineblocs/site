<?php
namespace App\NumberService\ThirdParty;

use Log;
use App\Helpers\MainHelper;
use App\NumberService\NumberService;

/**
 * Class BulkVSNumberService
 * 
 * Integration service for BulkVS API.
 * Designed for pure wholesale voice termination and DID origination.
 */
class BulkVSNumberService extends NumberService 
{
    private $username;
    private $password;
    private $baseUrl = 'https://portal.bulkvs.com/api';

    /**
     * BulkVSNumberService constructor.
     *
     * @param array|null $serviceData Contains api_key (Username) and api_secret (Password)
     * @param array $config Additional configuration options
     */
    public function __construct($serviceData = NULL, $config = []) 
    {
        if (empty($serviceData) || empty($serviceData['api_key']) || empty($serviceData['api_secret'])) {
            $this->isUsable = false;
            return;
        }

        $this->config = $config;
        $this->username = $serviceData['api_key'];
        $this->password = $serviceData['api_secret'];
        $this->isUsable = true;
    }

    public function getName() 
    {
        return "BulkVS";
    }

    /**
     * Searches available phone numbers in BulkVS inventory.
     */
    public function listNumbersAPI($country, $region, $prefix = "", $rateCenter = "", $type = "local", $for = "voice", $extras = [])
    {
        $queryParams = [
            'limit' => 50
        ];

        if (!empty($region)) {
            $queryParams['state'] = $region;
        }
        if (!empty($prefix)) {
            $queryParams['npa'] = substr($prefix, 0, 3);
        }

        $response = $this->makeRequest('GET', '/v1/numbers/search?' . http_build_query($queryParams));

        if (!$response || !isset($response['results'])) {
            return [];
        }

        $numbers = [];
        foreach ($response['results'] as $item) {
            $attrs = [
                'country' => $country,
                'api_number' => $item['did'],
                'number' => MainHelper::toE164($item['did']),
                'region' => $item['state'] ?? $region,
                'monthly_cost' => '0.06', // BulkVS has extremely low tier-1 costs
                'setup_cost' => '0.06',
                'features' => ['voice'],
                'type' => $type
            ];
            $numbers[] = $this->numberArray($attrs);
        }

        return $numbers;
    }

    /**
     * Orders a DID from BulkVS.
     */
    public function register($workspace, $type, $number, $region = NULL, $cost = NULL)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $payload = [
            'did' => $cleanNumber,
            'trunk_id' => $this->config['trunk_id'] ?? null
        ];

        $response = $this->makeRequest('POST', '/v1/numbers/order', $payload);

        if (isset($response['status']) && $response['status'] === 'success') {
            Log::info("BulkVS DID successfully purchased: {$number}");
            return true;
        }

        Log::error("BulkVS DID purchase failed for: {$number}", ['response' => $response]);
        return false;
    }

    /**
     * Cancels a DID back to BulkVS.
     */
    public function unrent($number)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $response = $this->makeRequest('DELETE', "/v1/numbers/{$cleanNumber}");

        if (isset($response['status']) && $response['status'] === 'success') {
            Log::info("BulkVS released DID: {$number}");
            return true;
        }

        return false;
    }

    /**
     * Internal cURL helper for BulkVS REST API.
     */
    private function makeRequest($method, $endpoint, $payload = null)
    {
        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->username}:{$this->password}");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        
        $headers = [
            'Accept: application/json',
            'Content-Type: application/json'
        ];

        if ($payload && in_array($method, ['POST', 'PUT'])) {
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