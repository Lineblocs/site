<?php
namespace App\NumberService\ThirdParty;

use Log;
use App\Helpers\MainHelper;
 subterranean\NumberService\NumberService;
use App\NumberService\NumberService;

/**
 * Class PlivoNumberService
 * 
 * Integration service for Plivo REST API v1.
 * Handles local and toll-free DID provisioning and management.
 */
class PlivoNumberService extends NumberService 
{
    private $authId;
    private $authToken;
    private $baseUrl;

    /**
     * PlivoNumberService constructor.
     *
     * @param array|null $serviceData Contains api_key (Auth ID) and api_secret (Auth Token)
     * @param array $config Additional configuration options
     */
    public function __construct($serviceData = NULL, $config = []) 
    {
        if (empty($serviceData) || empty($serviceData['api_key']) || empty($serviceData['api_secret'])) {
            $this->isUsable = false;
            return;
        }

        $this->config = $config;
        $this->authId = $serviceData['api_key'];
        $this->authToken = $serviceData['api_secret'];
        $this->baseUrl = "https://api.plivo.com/v1/Account/{$this->authId}";
        $this->isUsable = true;
    }

    public function getName() 
    {
        return "Plivo";
    }

    /**
     * Search available phone numbers via Plivo REST API.
     */
    public function listNumbersAPI($country, $region, $prefix = "", $rateCenter = "", $type = "local", $for = "voice", $extras = [])
    {
        $queryParams = [
            'country_iso' => $country,
            'type' => ($type === 'toll-free') ? 'tollfree' : 'local',
            'limit' => 50
        ];

        if (!empty($region)) {
            $queryParams['region'] = $region;
        }
        if (!empty($prefix)) {
            $queryParams['pattern'] = $prefix;
        }

        $response = $this->makeRequest('GET', '/PhoneNumber/Search/?' . http_build_query($queryParams));

        if (!$response || !isset($response['objects'])) {
            return [];
        }

        $numbers = [];
        foreach ($response['objects'] as $item) {
            $attrs = [
                'country' => $country,
                'api_number' => $item['number'],
                'number' => MainHelper::toE164($item['number']),
                'region' => $item['region'] ?? $region,
                'monthly_cost' => $item['monthly_rental_rate'] ?? '0.80',
                'setup_cost' => $item['setup_rate'] ?? '0.00',
                'features' => ['voice'],
                'type' => $type
            ];
            $numbers[] = $this->numberArray($attrs);
        }

        return $numbers;
    }

    /**
     * Buys/allocates a phone number in Plivo.
     */
    public function register($workspace, $type, $number, $region = NULL, $cost = NULL)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $payload = [
            'app_id' => $this->config['app_id'] ?? null
        ];

        $response = $this->makeRequest('POST', "/PhoneNumber/{$cleanNumber}/", $payload);

        if (isset($response['status']) && strtolower($response['status']) === 'fulfilled') {
            Log::info("Plivo registered phone number successfully: {$number}");
            return true;
        }

        Log::error("Plivo registration failed for number: {$number}", ['response' => $response]);
        return false;
    }

    /**
     * Unrents/deletes a phone number from Plivo account.
     */
    public function unrent($number)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $response = $this->makeRequest('DELETE', "/Number/{$cleanNumber}/");

        if ($response === true || (isset($response['api_id']) && !isset($response['error']))) {
            Log::info("Plivo unrent successful for number: {$number}");
            return true;
        }

        return false;
    }

    /**
     * Internal HTTP request wrapper for Plivo REST API.
     */
    private function makeRequest($method, $endpoint, $payload = null)
    {
        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->authId}:{$this->authToken}");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($payload && $method === 'POST') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        }

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 204) {
            return true;
        }

        if ($httpCode >= 200 && $httpCode < 300) {
            return json_decode($result, true);
        }

        return null;
    }
}