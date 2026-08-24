<?php
namespace App\NumberService\ThirdParty;

use Log;
use App\Helpers\MainHelper;
use App\NumberService\NumberService;

/**
 * Class VoIPInnovationsNumberService
 * 
 * Integration service for VoIP Innovations (Sangoma) API.
 * Manages core wholesale DID acquisition and unallocation.
 */
class VoIPInnovationsNumberService extends NumberService 
{
    private $apiLogin;
    private $apiSecret;
    private $baseUrl = 'https://api.voipinnovations.com/v1'; // Standardized REST layer

    /**
     * VoIPInnovationsNumberService constructor.
     *
     * @param array|null $serviceData Contains api_key (Login) and api_secret (Secret)
     * @param array $config Additional configuration options
     */
    public function __construct($serviceData = NULL, $config = []) 
    {
        if (empty($serviceData) || empty($serviceData['api_key']) || empty($serviceData['api_secret'])) {
            $this->isUsable = false;
            return;
        }

        $this->config = $config;
        $this->apiLogin = $serviceData['api_key'];
        $this->apiSecret = $serviceData['api_secret'];
        $this->isUsable = true;
    }

    public function getName() 
    {
        return "VoIPInnovations";
    }

    /**
     * Searches available phone numbers in VoIP Innovations inventory.
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

        $response = $this->makeRequest('GET', '/dids/search?' . http_build_query($queryParams));

        if (!$response || !isset($response['DIDs'])) {
            return [];
        }

        $numbers = [];
        foreach ($response['DIDs'] as $item) {
            $attrs = [
                'country' => $country,
                'api_number' => $item['TN'],
                'number' => MainHelper::toE164($item['TN']),
                'region' => $item['State'] ?? $region,
                'monthly_cost' => $item['MonthlyTier'] ?? '1.00',
                'setup_cost' => $item['SetupTier'] ?? '1.00',
                'features' => ['voice'],
                'type' => $type
            ];
            $numbers[] = $this->numberArray($attrs);
        }

        return $numbers;
    }

    /**
     * Allocates a DID from VoIP Innovations.
     */
    public function register($workspace, $type, $number, $region = NULL, $cost = NULL)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $payload = [
            'TN' => $cleanNumber,
            'EndpointGroup' => $this->config['endpoint_group'] ?? null
        ];

        $response = $this->makeRequest('POST', '/dids/assign', $payload);

        if (isset($response['Status']) && $response['Status'] === 'Success') {
            Log::info("VoIP Innovations DID successfully registered: {$number}");
            return true;
        }

        Log::error("VoIP Innovations DID registration failed for: {$number}", ['response' => $response]);
        return false;
    }

    /**
     * Cancels a DID back to VoIP Innovations.
     */
    public function unrent($number)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $payload = [
            'TN' => $cleanNumber
        ];

        $response = $this->makeRequest('POST', '/dids/release', $payload);

        if (isset($response['Status']) && $response['Status'] === 'Success') {
            Log::info("VoIP Innovations released DID: {$number}");
            return true;
        }

        return false;
    }

    /**
     * Internal cURL helper for VoIP Innovations REST API.
     */
    private function makeRequest($method, $endpoint, $payload = null)
    {
        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        
        $headers = [
            'Authorization: Basic ' . base64_encode("{$this->apiLogin}:{$this->apiSecret}"),
            'Content-Type: application/json',
            'Accept: application/json'
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