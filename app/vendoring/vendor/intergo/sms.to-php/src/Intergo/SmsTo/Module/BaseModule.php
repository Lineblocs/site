<?php


namespace Intergo\SmsTo\Module;


use Exception;
use Intergo\SmsTo\Credentials\ICredential;
use Intergo\SmsTo\Exceptions\InvalidCredentialException;

/**
 * Class BaseModule
 * @package Intergo\SmsTo\Module
 */
class BaseModule
{
    /**
     * @var ICredential
     */
    protected $credentials;

    /**
     * @var
     */
    protected $url;

    /**
     * @var string
     */
    protected $apiVersion = 'v1';

    /**
     * BaseModule constructor.
     * @param ICredential $credentials
     */
    public function __construct(ICredential $credentials = null)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param string $url
     * @return BaseModule
     * @throws InvalidCredentialException
     */
    public function setBaseUrl(string $url)
    {
        $this->url = $url;
        if(!$this->credentials) {
            throw new InvalidCredentialException("Invalid Credentials");
        }
        $this->credentials->setBaseUrl($url);
        return $this;
    }

    /**
     * @param string $apiVersion
     * @return BaseModule
     */
    public function setApiVersion(string $apiVersion)
    {
        $this->apiVersion = $apiVersion;
        return $this;
    }

    public function withCredentials(ICredential $credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * @return ICredential
     */
    public function getCredentials(): ICredential
    {
        return $this->credentials;
    }

    /**
     * @param array $response
     * @return array
     * @throws Exception
     */
    protected function response(array $response): array
    {
        if(isset($response['success']) && !$response['success']) {
            throw new Exception($response['message']);
        }
        return $response;
    }
}