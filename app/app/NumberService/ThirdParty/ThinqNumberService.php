<?php
namespace App\NumberService\ThirdParty;

use Log;
use App\Helpers\MainHelper;
use App\NumberService\NumberService;

/**
 * Class ThinqNumberService
 * 
 * Integration service for ThinQ / IntelePeer REST API v2.
 * Handles wholesale LCR and DID management across North America.
 */
class ThinqNumberService extends NumberService 
{
    private $accountToken;
    private $apiUser;
    private $apiKey;
    private $baseUrl;

    /**
     * ThinqNumberService constructor.
     *
     * @param array|null $serviceData Contains api_key (User) and api_secret (Key)
     * @param array $config Must contain 'account_token' / account ID
     */
    public function __construct($serviceData = NULL, $config = []) 
    {
        if (empty($serviceData) || empty($serviceData['api_key']) || empty($serviceData['api_secret']) || empty($config['account_token'])) {
            $this->isUsable = false;
            return;
        }

        $this->config = $config;
        $this->apiUser = $serviceData['api_key'];
        $this->apiKey = $serviceData['api_secret'];
        $this->accountToken = $config['account_token'];
        $this->baseUrl = "https://api.thinq.com/v2/account/{$this->accountToken}";
        $this->isUsable = true;
    }

    public function getName() 
    {
        return "Thinq";
    }

    /**
     * Search available DIDs in Thinq/IntelePeer carrier pool.
     */
    public function listNumbersAPI($country, $region, $prefix = "", $rateCenter = "", $type = "local", $for = "voice", $extras = [])
    {
        $queryParams = ['limit' => 50];

        if (!empty($region)) {
            $queryParams['state'] = $region;
        }
        if (!empty($prefix)) {
            $queryParams['npa'] = substr($prefix, 0, 3);
        }

        $endpoint = ($type === 'toll-free') ? '/origination/did/search/tollfree?' : '/origination/did/search/local?';
        $response = $this->makeRequest('GET', $endpoint . http_build_query($queryParams));

        if (!$response || !isset($response['dids'])) {
            return [];
        }

        $numbers = [];
        foreach ($response['dids'] as $item) {
            $attrs = [
                'country' => $country,
                'api_number' => $item['id'],
                'number' => MainHelper::toE164($item['id']),
                'region' => $item['state'] ?? $region,
                'monthly_cost' => '0.40',
                'setup_cost' => '0.40',
                'features' => ['voice'],
                'type' => $type
            ];
            $numbers[] = $this->numberArray($attrs);
        }

        return $numbers;
    }

    /**
     * Orders a DID via Thinq REST API.
     */
    public function register($workspace, $type, $number, $region = NULL, $cost = NULL)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $payload = [
            'did' => $cleanNumber
        ];

        $response = $this->makeRequest('POST', '/origination/did/order', $payload);

        if (isset($response['code']) && $response['code'] == 200) {
            Log::info("Thinq successfully registered number: {$number}");
            return true;
        }

        Log::error("Thinq registration failed for number: {$number}", ['response' => $response]);
        return false;
    }

    /**
     * Releases a DID back to Thinq.
     */
    public function unrent($number)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);
        $response = $this->makeRequest('DELETE', "/origination/did/{$cleanNumber}");

        if (isset($response['code']) && $response['code'] == 200) {
            Log::info("Thinq released number: {$number}");
            return true;
        }

        return false;
    }

    /**
     * Internal HTTP client using HTTP Basic auth for Thinq API.
     */
    private function makeRequest($method, $endpoint, $payload = null)
    {
        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->apiUser}:{$this->apiKey}");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($payload && in_array($method, ['POST', 'PUT', 'DELETE'])) {
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