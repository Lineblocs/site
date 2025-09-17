<?php


namespace Intergo\SmsTo\Module\Shortlink;


use Intergo\SmsTo\Credentials\ICredential;
use Intergo\SmsTo\Http\Client;
use Intergo\SmsTo\Module\BaseModule;

/**
 * Class Shortlink
 * @package Intergo\SmsTo\Module\Shortlink
 */
class Shortlink extends BaseModule
{
    /**
     * @var string
     */
    protected $url = 'https://sms.to';

    /**
     * @var string
     */
    protected $apiVersion = 'api/v1';

    /**
     * Create new shortlink
     *
     * @param string $name
     * @param string $url
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(string $name, string $url)
    {
        $data = [
            'name' => $name,
            'url' => $url
        ];

        $url = $this->url . '/' . $this->apiVersion . '/shortlink';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }

    /**
     * Get all shortlinks
     *
     * @param int $limit
     * @param int $page
     * @param string $sort
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all($limit = 20, $page = 1, $sort = 'created_at')
    {
        $payload = [
            'limit' => $limit,
            'page' => $page,
            'sort' => $sort
        ];
        $queryString = http_build_query($payload);
        $url = $this->url . '/' . $this->apiVersion . '/shortlinks?' . $queryString;
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Get shorlink report by ID
     *
     * @param $id
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByID($id)
    {
        $url = $this->url . '/' . $this->apiVersion . '/shortlinks/' . $id;
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Delete shortlink by ID
     *
     * @param $id
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteByID($id)
    {
        $url = $this->url . '/' . $this->apiVersion . '/shortlinks/' . $id . '/delete';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url)->json(true));
    }
}