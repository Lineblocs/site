<?php


namespace Intergo\SmsTo\Module\NumberLookup;


use Intergo\SmsTo\Credentials\ICredential;
use Intergo\SmsTo\Http\Client;
use Intergo\SmsTo\Module\BaseModule;

/**
 * Class NumberLookup
 * @package Intergo\SmsTo\Module\NumberLookup
 */
class NumberLookup extends BaseModule
{
    /**
     * @var string
     */
    protected $url = 'https://sms.to';

    /**
     * Estimate the cost of number lookup
     *
     * @param string $phone
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function estimate(string $phone)
    {
        $data = ['to' => $phone];
        $url = $this->url . '/' . $this->apiVersion . '/verify/number/estimate';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }

    /**
     * Verify the phone if active or different status
     *
     * @param string $phone
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function verify(string $phone)
    {
        $data = ['to' => $phone];
        $url = $this->url . '/' . $this->apiVersion . '/verify/number';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }
}