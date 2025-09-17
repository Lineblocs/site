<?php


namespace Intergo\SmsTo\Credentials;

use GuzzleHttp\Exception\GuzzleException;
use Intergo\SmsTo\Http\Client;
use Exception;

class ApiKeyCredential implements ICredential
{
    /**
     * @var string
     */
    private $type = 'api-key';

    /**
     * @var string
     */
    private $url = 'https://auth.sms.to';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * ApiKeyCredential constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Verify if the API Key is valid
     *
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function verify(): array
    {
        $url = $this->url . '/api/balance';
        $headers = Client::JSON_HEADERS;
        $headers['Authorization'] = 'Bearer ' . $this->apiKey;
        $headers['X-Smsto-Sdk'] = $this->apiKey;
        $response = Client::withHeaders($headers)->get($url)->json(true);
        if(!isset($response['balance']))
        {
            throw new Exception($response['message']);
        }
        return $response;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->apiKey;
    }

    /**
     * @return array|string[]
     */
    public function getAuthHeader(): array
    {
        if(empty($this->apiKey))
        {
            return [];
        }
        return [
            'Authorization' => 'Bearer ' . $this->apiKey
        ];
    }

    /**
     * For API Key not required
     *
     * @return array
     */
    public function refreshToken(): array
    {
        return [];
    }

    /**
     * For API Key not required
     *
     * @return int
     */
    public function getExpireTTL(): int
    {
        return 0;
    }

    /**
     * This is required for our test servers only for testing
     *
     * @param string $url
     */
    public function setBaseUrl(string $url)
    {
        $this->url = $url;
    }
}