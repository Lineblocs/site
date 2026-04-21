<?php


namespace Intergo\SmsTo\Module\Contact;


use Intergo\SmsTo\Credentials\ICredential;
use Intergo\SmsTo\Http\Client;
use Intergo\SmsTo\Module\BaseModule;

/**
 * Provide methods for managing contacts
 *
 * Class Contact
 * @package Intergo\SmsTo\Module\Contact
 */
class Contact extends BaseModule
{
    /**
     * @var string
     */
    protected $url = 'https://sms.to';

    /**
     * Create Contact List
     *
     * @param $name
     * @param $description
     * @param int $shareWithTeam
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createList($name, $description, $shareWithTeam = 0)
    {
        $data = [
            'name' => $name,
            'description' => $description,
            'share_with_team' => $shareWithTeam
        ];
        $url = $this->url . '/' . $this->apiVersion . '/people/lists/create';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }

    /**
     * Create Contact by phone
     *
     * @param string $phone
     * @param $listIds
     * @param array $otherData
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(string $phone, $listIds, array $otherData = [])
    {
        $data = [
            'phone' => $phone,
            'list_ids' => $listIds,
        ];
        $data = array_merge($data, $otherData);
        $url = $this->url . '/' . $this->apiVersion . '/people/contacts/create';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }

    /**
     * Delete Contact by Phone
     *
     * @param $phone
     * @param array $listIds
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteByPhone($phone, $listIds = [])
    {
        $data = [
            'phone' => $phone,
            'list_id' => $listIds,
        ];
        $url = $this->url . '/' . $this->apiVersion . '/people/contacts/delete-phone';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }

    /**
     * Optin Contact by phone
     *
     * @param $phone
     * @param array $listIds
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function optinByPhone($phone, $listIds = [])
    {
        $data = [
            'phone' => $phone,
            'list_id' => $listIds,
        ];
        $url = $this->url . '/' . $this->apiVersion . '/people/contacts/optin';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }

    /**
     * Optout Contact by phone
     *
     * @param $phone
     * @param array $listIds
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function optoutByPhone($phone, $listIds = [])
    {
        $data = [
            'phone' => $phone,
            'list_id' => $listIds,
        ];
        $url = $this->url . '/' . $this->apiVersion . '/people/contacts/optout';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }

    /**
     * Get recent optouts
     *
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function recentOptouts()
    {
        $url = $this->url . '/' . $this->apiVersion . '/recent/optouts';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Get Contact List by List ID
     *
     * @param $id
     * @param int $limit
     * @param int $page
     * @param string $orderBy
     * @param string $direction
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getContactListByListID($id, $limit = 100, $page = 1, $orderBy = 'firstname', $direction = 'ASC')
    {
        $payload = [
            'list_ids' => $id,
            'limit' => $limit,
            'page' => $page,
            'order_by' => $orderBy,
            'direction' => $direction,
        ];
        $queryString = http_build_query($payload);
        $url = $this->url . '/' . $this->apiVersion . '/people/contacts?' . $queryString;
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Get all contact list
     *
     * @param string $name
     * @param int $page
     * @param string $direction
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function allList($name = '', $page = 1, $direction = 'ASC')
    {
        $payload = ['direction' => $direction];
        if(!empty($name))
        {
            $payload['name'] = $name;
        }
        if(!empty($page))
        {
            $payload['page'] = $page;
        }
        $queryString = http_build_query($payload);
        $url = $this->url . '/' . $this->apiVersion . '/people/lists?' . $queryString;
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Delete Contact list by list ID
     *
     * @param $id
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteListByID($id)
    {
        $url = $this->url . '/' . $this->apiVersion . '/people/lists/' . $id . '/delete';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->delete($url)->json(true));
    }
}