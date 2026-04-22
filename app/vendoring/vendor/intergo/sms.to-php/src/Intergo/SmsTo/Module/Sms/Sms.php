<?php


namespace Intergo\SmsTo\Module\Sms;


use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Intergo\SmsTo\Credentials\ICredential;
use Intergo\SmsTo\Http\Client;
use Intergo\SmsTo\Module\BaseModule;
use Intergo\SmsTo\Module\Sms\Message\IMessage;

/**
 * Class Sms
 * @package Intergo\SmsTo\Module\Sms
 */
class Sms extends BaseModule
{
    /**
     * @var string
     */
    protected $url = 'https://api.sms.to';

    /**
     * @var string
     */
    private $type = 'sms';

    /**
     * @var string[]
     */
    private $allowed_types = ['sms', 'fsms', 'viber'];

    /**
     * Estimate SMS
     *
     * @param IMessage $message
     * @return array|mixed|\stdClass
     * @throws GuzzleException
     */
    public function estimate(IMessage $message)
    {
        $data = $message->prepare();
        $url = $this->url . '/' . $this->type . '/estimate';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }

    /**
     * Send SMS
     *
     * @param IMessage $message
     * @return array|mixed|\stdClass
     * @throws GuzzleException
     */
    public function send(IMessage $message)
    {
        $data = $message->prepare();
        $url = $this->url . '/' . $this->type . '/send';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }

    /**
     * Get all campaigns
     *
     * @return array|mixed|\stdClass
     * @throws GuzzleException
     */
    public function getCampaigns()
    {
        $url = $this->url . '/campaigns';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Get Last Campaign
     *
     * @return array|mixed|\stdClass
     * @throws GuzzleException
     */
    public function getLastCampaign()
    {
        $url = $this->url . '/last/campaign';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Get campaign by ID
     *
     * @param string $id
     * @return array|mixed|\stdClass
     * @throws GuzzleException
     */
    public function getCampaignByID(string $id)
    {
        $url = $this->url . '/campaigns/' . $id;
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Get all messages
     *
     * @return array|mixed|\stdClass
     * @throws GuzzleException
     */
    public function getMessages()
    {
        $url = $this->url . '/messages';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Get last message
     *
     * @return array|mixed|\stdClass
     * @throws GuzzleException
     */
    public function getLastMessage()
    {
        $url = $this->url . '/last/message';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Get message by ID
     *
     * @param string $id
     * @return array
     * @throws GuzzleException
     */
    public function getMessageByID(string $id)
    {
        $url = $this->url . '/message/' . $id;
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function isOptedOut(string $phone, string $defaultPrefix = null)
    {
        $url = $this->url . '/phone/status';
        $payload = [
            'phone' => $phone,
            'default_prefix' => $defaultPrefix
        ];
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $payload)->json(true));
    }

    /**
     * Set SMS type: sms, fsms or viber
     * @throws Exception
     */
    public function setType(string $type)
    {
        if(!in_array($type, $this->allowed_types))
        {
            throw new Exception("Invalid Type. Provide appropriate type: sms, fsms or viber");
        }
        $this->type = $type;
    }
}