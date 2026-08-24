<?php
namespace App\NumberService\ThirdParty;

use Log;
use App\Helpers\MainHelper;
use App\NumberService\NumberService;

/**
 * Class SkyetelNumberService
 * 
 * Integration service for Skyetel REST API.
 * Manages wholesale SIP trunking DID search, purchasing, and releasing.
 */
class SkyetelNumberService extends NumberService 
{
    private $sid;
    private $secret;
    private $baseUrl = 'https://api.skyetel.com/v1';

    /**
     * SkyetelNumberService constructor.
     *
     * @param array|null $serviceData Contains api_key (SID) and api_secret (Secret)
     * @param array $config Additional configuration options
     */
    public function __construct($serviceData = NULL, $config = []) 
    {
        if (empty($serviceData) || empty($serviceData['api_key']) || empty($serviceData['api_secret'])) {
            $this->isUsable = false;
            return;
        }

        $this->config = $config;
        $this->sid = $serviceData['api_key'];
        $this->secret = $serviceData['api_secret'];
        $this->isUsable = true;
    }

    public function getName() 
    {
        return "Skyetel";
    }

    /**
     * Searches available phone numbers in Skyetel inventory.
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

        // Skyetel separates toll-free and local searches
        $endpoint = ($type === 'toll-free') ? '/dids/search/tollfree?' : '/dids/search/local?';
        $response = $this->makeRequest('GET', $endpoint . http_build_query($queryParams));

        if (!$response || !isset($response['data'])) {
            return [];
        }

        $numbers = [];
        foreach ($response['data'] as $item) {
            $attrs = [
                'country' => $country,
                'api_number' => $item['did'],
                'number' => MainHelper::toE164($item['did']),
                'region' => $item['state'] ?? $region,
                'monthly_cost' => '1.00',
                'setup_cost' => '1.00',
                'features' => ['voice'],
                'type' => $type
            ];
            $numbers[] = $this->numberArray($attrs);
        }

        return $numbers;
    }

    /**
     * Orders a DID from Skyetel.
     */
    public function register($workspace, $type, $number, $region = NULL, $cost = NULL)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $payload = [
            'did' => $cleanNumber,
            'endpoint_group_id' => $this->config['endpoint_group_id'] ?? null
        ];

        $response = $this->makeRequest('POST', '/dids/buy', $payload);

        if (isset($response['status']) && $response['status'] === 'success') {
            Log::info("Skyetel DID successfully purchased: {$number}");
            return true;
        }

        Log::error("Skyetel DID purchase failed for: {$number}", ['response' => $response]);
        return false;
    }

    /**
     * Releases a DID back to Skyetel.
     */
    public function unrent($number)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $response = $this->makeRequest('DELETE', "/dids/{$cleanNumber}");

        if (isset($response['status']) && $response['status'] === 'success') {
            Log::info("Skyetel released DID: {$number}");
            return true;
        }

        return false;
    }

    /**
     * Internal cURL helper for Skyetel REST API.
     */
    private function makeRequest($method, $endpoint, $payload = null)
    {
        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->sid}:{$this->secret}");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($payload && in_array($method, ['POST', 'PUT'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        }

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            return json_decode($result, true);
        }

        return null;
    }
}