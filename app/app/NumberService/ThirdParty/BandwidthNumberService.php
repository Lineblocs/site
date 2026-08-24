<?php
namespace App\NumberService\ThirdParty;

use Log;
use App\Helpers\MainHelper;
use App\NumberService\NumberService;

/**
 * Class BandwidthNumberService
 * 
 * Integration service for Bandwidth Dashboard v2 REST API.
 * Manages carrier-grade DID search, allocation, and release.
 */
class BandwidthNumberService extends NumberService 
{
    private $accountId;
    private $apiUser;
    private $apiPassword;
    private $baseUrl;

    /**
     * BandwidthNumberService constructor.
     *
     * @param array|null $serviceData Contains api_key (User), api_secret (Pass), and config['account_id']
     * @param array $config Additional configuration options
     */
    public function __construct($serviceData = NULL, $config = []) 
    {
        if (empty($serviceData) || empty($serviceData['api_key']) || empty($serviceData['api_secret']) || empty($config['account_id'])) {
            $this->isUsable = false;
            return;
        }

        $this->config = $config;
        $this->apiUser = $serviceData['api_key'];
        $this->apiPassword = $serviceData['api_secret'];
        $this->accountId = $config['account_id'];
        $this->baseUrl = "https://dashboard.bandwidth.com/api/accounts/{$this->accountId}";
        $this->isUsable = true;
    }

    public function getName() 
    {
        return "Bandwidth";
    }

    /**
     * Searches available phone numbers in Bandwidth pool.
     */
    public function listNumbersAPI($country, $region, $prefix = "", $rateCenter = "", $type = "local", $for = "voice", $extras = [])
    {
        $queryParams = [
            'quantity' => 50,
            'state' => $region
        ];

        if (!empty($rateCenter)) {
            $queryParams['rateCenter'] = $rateCenter;
        }

        $endpoint = "/availableNumbers?" . http_build_query($queryParams);
        $response = $this->makeRequest('GET', $endpoint);

        if (!$response || !isset($response['TelephoneNumberList']['TelephoneNumber'])) {
            return [];
        }

        $items = $response['TelephoneNumberList']['TelephoneNumber'];
        // Ensure array wrap if single element returned
        if (isset($items[0]) === false) {
            $items = [$items];
        }

        $numbers = [];
        foreach ($items as $item) {
            $did = is_array($item) ? $item[0] : $item;
            $attrs = [
                'country' => $country,
                'api_number' => $did,
                'number' => MainHelper::toE164($did),
                'region' => $region,
                'monthly_cost' => '0.50',
                'setup_cost' => '0.50',
                'features' => ['voice'],
                'type' => $type
            ];
            $numbers[] = $this->numberArray($attrs);
        }

        return $numbers;
    }

    /**
     * Orders a DID via Bandwidth XML/JSON Order endpoint.
     */
    public function register($workspace, $type, $number, $region = NULL, $cost = NULL)
    {
        $payload = [
            'Order' => [
                'Name' => "Order-{$workspace}-" . time(),
                'SiteId' => $this->config['site_id'] ?? null,
                'ExistingTelephoneNumberOrderType' => [
                    'TelephoneNumberList' => [
                        'TelephoneNumber' => MainHelper::toE164($number)
                    ]
                ]
            ]
        ];

        $response = $this->makeRequest('POST', '/orders', $payload);

        if (isset($response['OrderResponse']['Order']['id'])) {
            Log::info("Bandwidth DID registered successfully for {$number}");
            return true;
        }

        Log::error("Bandwidth registration failed for {$number}", ['response' => $response]);
        return false;
    }

    /**
     * Disconnects/unallocates a number in Bandwidth.
     */
    public function unrent($number)
    {
        $payload = [
            'DisconnectOrder' => [
                'Name' => "Disconnect-" . time(),
                'DisconnectTelephoneNumberOrderType' => [
                    'TelephoneNumberList' => [
                        'TelephoneNumber' => MainHelper::toE164($number)
                    ]
                ]
            ]
        ];

        $response = $this->makeRequest('POST', '/disconnects', $payload);

        if (isset($response['DisconnectOrderResponse']['DisconnectOrder']['id'])) {
            Log::info("Bandwidth disconnect submitted for {$number}");
            return true;
        }

        return false;
    }

    /**
     * Internal HTTP helper for Bandwidth Dashboard API.
     */
    private function makeRequest($method, $endpoint, $payload = null)
    {
        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->apiUser}:{$this->apiPassword}");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        $headers = ['Accept: application/json'];

        if ($payload) {
            $headers[] = 'Content-Type: application/json';
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