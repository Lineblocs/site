<?php
namespace App\NumberService\ThirdParty;

use Log;
use App\Helpers\MainHelper;
use App\NumberService\NumberService;

/**
 * Class FlowrouteNumberService
 * 
 * Integration service for Flowroute v2 REST API.
 * Focuses on direct wholesale SIP trunking and DID allocation.
 */
class FlowrouteNumberService extends NumberService 
{
    private $accessKey;
    private $secretKey;
    private $baseUrl = 'https://api.flowroute.com/v2';

    /**
     * FlowrouteNumberService constructor.
     *
     * @param array|null $serviceData Contains api_key (Access Key) and api_secret (Secret Key)
     * @param array $config Additional configuration parameters
     */
    public function __construct($serviceData = NULL, $config = []) 
    {
        if (empty($serviceData) || empty($serviceData['api_key']) || empty($serviceData['api_secret'])) {
            $this->isUsable = false;
            return;
        }

        $this->config = $config;
        $this->accessKey = $serviceData['api_key'];
        $this->secretKey = $serviceData['api_secret'];
        $this->isUsable = true;
    }

    public function getName() 
    {
        return "Flowroute";
    }

    /**
     * Search available DIDs in Flowroute repository.
     */
    public function listNumbersAPI($country, $region, $prefix = "", $rateCenter = "", $type = "local", $for = "voice", $extras = [])
    {
        $queryParams = ['limit' => 50];

        if (!empty($region)) {
            $queryParams['state'] = $region;
        }
        if (!empty($rateCenter)) {
            $queryParams['rate_center'] = $rateCenter;
        }
        if (!empty($prefix)) {
            $queryParams['starts_with'] = $prefix;
        }

        $response = $this->makeRequest('GET', '/numbers/available?' . http_build_query($queryParams));

        if (!$response || !isset($response['data'])) {
            return [];
        }

        $numbers = [];
        foreach ($response['data'] as $item) {
            $did = $item['id'];
            $attrs = [
                'country' => $country,
                'api_number' => $did,
                'number' => MainHelper::toE164($did),
                'region' => $item['attributes']['state'] ?? $region,
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
     * Purchases/allocates a DID in Flowroute.
     */
    public function register($workspace, $type, $number, $region = NULL, $cost = NULL)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $endpoint = "/numbers/{$cleanNumber}";

        $response = $this->makeRequest('POST', $endpoint);

        if (isset($response['data']['id'])) {
            Log::info("Flowroute successfully purchased DID: {$number}");
            return true;
        }

        Log::error("Flowroute purchase failed for DID: {$number}", ['response' => $response]);
        return false;
    }

    /**
     * Unroutes/releases a DID in Flowroute.
     */
    public function unrent($number)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $endpoint = "/numbers/{$cleanNumber}";

        $response = $this->makeRequest('DELETE', $endpoint);

        if ($response === true || (isset($response['data']['id']))) {
            Log::info("Flowroute released DID: {$number}");
            return true;
        }

        return false;
    }

    /**
     * Internal cURL helper using HTTP Basic auth for Flowroute API.
     */
    private function makeRequest($method, $endpoint, $payload = null)
    {
        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->accessKey}:{$this->secretKey}");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($payload && in_array($method, ['POST', 'PUT', 'PATCH'])) {
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