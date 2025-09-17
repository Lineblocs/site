<?php


namespace Intergo\SmsTo\Module\Auth;


use Exception;
use Intergo\SmsTo\Credentials\ICredential;
use Intergo\SmsTo\Http\Client;
use Intergo\SmsTo\Module\BaseModule;

/**
 * Provide credential interface for accessing other endpoints
 *
 * Class Credential
 * @package Intergo\SmsTo\Module\Auth
 */
class Credential extends BaseModule
{
    /**
     * @var string
     */
    protected $url = 'https://auth.sms.to';

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->credentials->getType();
    }

    /**
     * Verify different types of credentials: api-key or oauth
     *
     * @return ICredential
     */
    public function verify(): ICredential
    {
        $this->credentials->verify();
        return $this->credentials;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->credentials->getToken();
    }

    /**
     * @return array
     */
    public function getAuthHeader(): array
    {
        return $this->credentials->getAuthHeader();
    }

    /**
     * @return array
     */
    public function refreshToken(): array
    {
        return $this->credentials->refreshToken();
    }

    /**
     * @return array
     */
    public function getExpireTTL(): array
    {
        return $this->credentials->getExpireTTL();
    }

    /**
     * Get balance of user
     *
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception
     */
    public function getBalance()
    {
        $url = $this->url . '/api/balance';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }
}