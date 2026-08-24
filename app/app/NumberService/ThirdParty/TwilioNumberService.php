<?php
namespace App\NumberService\ThirdParty;

use Log;
use App\Helpers\MainHelper;
use App\NumberService\NumberService;

/**
 * Class TwilioNumberService
 * 
 * Integration service for Twilio REST API.
 * Handles listing, purchasing, and releasing Elastic SIP / Incoming Phone Numbers.
 */
class TwilioNumberService extends NumberService 
{
    private $accountSid;
    private $authToken;
    private $baseUrl;

    /**
     * TwilioNumberService constructor.
     *
     * @param array|null $serviceData Contains api_key (Account SID) and api_secret (Auth Token)
     * @param array $config Additional configuration options
     */
    public function __construct($serviceData = NULL, $config = []) 
    {
        if (empty($serviceData) || empty($serviceData['api_key']) || empty($serviceData['api_secret'])) {
            $this->isUsable = false;
            return;
        }

        $this->config = $config;
        $this->accountSid = $serviceData['api_key'];
        $this->authToken = $serviceData['api_secret'];
        $this->baseUrl = "https://api.twilio.com/2010-04-01/Accounts/{$this->accountSid}";
        $this->isUsable = true;
    }

    public function getName() 
    {
        return "Twilio";
    }

    /**
     * Search available numbers in Twilio inventory.
     */
    public function listNumbersAPI($country, $region, $prefix = "", $rateCenter = "", $type = "local", $for = "voice", $extras = [])
    {
        $endpointType = ($type === 'toll-free') ? 'TollFree' : 'Local';
        $queryParams = ['PageSize' => 50];

        if (!empty($region)) {
            $queryParams['InRegion'] = $region;
        }
        if (!empty($prefix)) {
            $queryParams['Contains'] = $prefix;
        }

        $endpoint = "/AvailablePhoneNumbers/{$country}/{$endpointType}.json?" . http_build_query($queryParams);
        $response = $this->makeRequest('GET', $endpoint);

        if (!$response || !isset($response['available_phone_numbers'])) {
            return [];
        }

        $numbers = [];
        foreach ($response['available_phone_numbers'] as $item) {
            $attrs = [
                'country' => $country,
                'api_number' => $item['phone_number'],
                'number' => MainHelper::toE164($item['phone_number']),
                'region' => $item['region'] ?? $region,
                'monthly_cost' => '1.15',
                'setup_cost' => '1.15',
                'features' => ['voice'],
                'type' => $type
            ];
            $numbers[] = $this->numberArray($attrs);
        }

        return $numbers;
    }

    /**
     * Provisions/allocates a phone number on Twilio and links it to a Trunk SID if configured.
     */
    public function register($workspace, $type, $number, $region = NULL, $cost = NULL)
    {
        $payload = [
            'PhoneNumber' => $number,
        ];

        if (!empty($this->config['trunk_sid'])) {
            $payload['TrunkSid'] = $this->config['trunk_sid'];
        }

        $response = $this->makeRequest('POST', '/IncomingPhoneNumbers.json', $payload);

        if (isset($response['sid'])) {
            Log::info("Twilio successfully registered number: {$number} (SID: {$response['sid']})");
            return true;
        }

        Log::error("Twilio registration failed for number: {$number}", ['response' => $response]);
        return false;
    }

    /**
     * Releases/unallocates a phone number on Twilio.
     */
    public function unrent($number)
    {
        // Search active IncomingPhoneNumbers by phone number string
        $search = $this->makeRequest('GET', '/IncomingPhoneNumbers.json?PhoneNumber=' . urlencode($number));

        if (empty($search['incoming_phone_numbers'][0]['sid'])) {
            Log::error("Twilio unrent failed: SID not found for number {$number}");
            return false;
        }

        $sid = $search['incoming_phone_numbers'][0]['sid'];
        $response = $this->makeRequest('DELETE', "/IncomingPhoneNumbers/{$sid}.json");

        if ($response === true) { // 204 No Content returned on success
            Log::info("Twilio unrent successful for number: {$number}");
            return true;
        }

        return false;
    }

    /**
     * Internal cURL helper for Twilio REST API.
     */
    private function makeRequest($method, $endpoint, $payload = null)
    {
        $ch = curl_init($this->baseUrl . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->accountSid}:{$this->authToken}");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($payload && $method === 'POST') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
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