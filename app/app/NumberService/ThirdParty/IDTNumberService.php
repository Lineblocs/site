<?php
namespace App\NumberService\ThirdParty;

use Log;
use App\Helpers\MainHelper;
use App\NumberService\NumberService;

/**
 * Class IDTNumberService
 * 
 * Integration service for IDT Express / IDT Wholesale REST API.
 * Manages carrier-level DID provisioning.
 */
class IDTNumberService extends NumberService 
{
    private $apiKey;
    private $apiSecret;
    private $baseUrl = 'https://api.idtexpress.com/v1';

    /**
     * IDTNumberService constructor.
     *
     * @param array|null $serviceData Contains api_key and api_secret
     * @param array $config Additional provider configurations
     */
    public function __construct($serviceData = NULL, $config = []) 
    {
        if (empty($serviceData) || empty($serviceData['api_key']) || empty($serviceData['api_secret'])) {
            $this->isUsable = false;
            return;
        }

        $this->config = $config;
        $this->apiKey = $serviceData['api_key'];
        $this->apiSecret = $serviceData['api_secret'];
        $this->isUsable = true;
    }

    public function getName() 
    {
        return "IDT";
    }

    /**
     * Searches IDT wholesale DID inventory.
     */
    public function listNumbersAPI($country, $region, $prefix = "", $rateCenter = "", $type = "local", $for = "voice", $extras = [])
    {
        $queryParams = [
            'country' => $country,
            'state' => $region,
            'limit' => 50
        ];

        if (!empty($prefix)) {
            $queryParams['prefix'] = $prefix;
        }

        $response = $this->makeRequest('GET', '/dids/search?' . http_build_query($queryParams));

        if (!$response || !isset($response['dids'])) {
            return [];
        }

        $numbers = [];
        foreach ($response['dids'] as $item) {
            $attrs = [
                'country' => $country,
                'api_number' => $item['number'],
                'number' => MainHelper::toE164($item['number']),
                'region' => $item['state'] ?? $region,
                'monthly_cost' => $item['monthly_fee'] ?? '0.75',
                'setup_cost' => $item['setup_fee'] ?? '0.75',
                'features' => ['voice'],
                'type' => $type
            ];
            $numbers[] = $this->numberArray($attrs);
        }

        return $numbers;
    }

    /**
     * Allocates a DID from IDT carrier network.
     */
    public function register($workspace, $type, $number, $region = NULL, $cost = NULL)
    {
        $payload = [
            'number' => MainHelper::toE164($number),
            'trunk_group_id' => $this->config['trunk_group_id'] ?? null
        ];

        $response = $this->makeRequest('POST', '/dids/order', $payload);

        if (isset($response['status']) && $response['status'] === 'success') {
            Log::info("IDT DID successfully ordered: {$number}");
            return true;
        }

        Log::error("IDT DID ordering failed for: {$number}", ['response' => $response]);
        return false;
    }

    /**
     * Unallocates a DID from IDT.
     */
    public function unrent($number)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $response = $this->makeRequest('DELETE', "/dids/{$cleanNumber}");

        if (isset($response['status']) && $response['status'] === 'success') {
            Log::info("IDT DID released: {$number}");
            return true;
        }

        return false;
    }

    /**
     * Internal cURL helper with IDT API headers.
     */
    private function makeRequest($method, $endpoint, $payload = null)
    {
        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        $headers = [
            'x-api-key: ' . $this->apiKey,
            'x-api-secret: ' . $this->apiSecret,
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