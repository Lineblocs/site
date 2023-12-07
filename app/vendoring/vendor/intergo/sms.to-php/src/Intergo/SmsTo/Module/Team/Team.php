<?php


namespace Intergo\SmsTo\Module\Team;


use Intergo\SmsTo\Credentials\ICredential;
use Intergo\SmsTo\Http\Client;
use Intergo\SmsTo\Module\BaseModule;

/**
 * Class Team
 * @package Intergo\SmsTo\Module\Team
 */
class Team extends BaseModule
{
    /**
     * @var string
     */
    protected $url = 'https://sms.to';

    /**
     * Get all members of a team
     *
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function allMembers()
    {
        $url = $this->url . '/' . $this->apiVersion . '/team/users';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Get all email invitations with their status
     *
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function allInvitations()
    {
        $url = $this->url . '/' . $this->apiVersion . '/team/invitations';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Generate member
     *
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function generateMember()
    {
        $data = [
            'auto_generate_credentials' => true,
            'terms_conditions' => true,
        ];
        $url = $this->url . '/' . $this->apiVersion . '/team/user/create';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }

    /**
     * Invite member to team by email
     *
     * @param string $email
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function inviteMemberByEmail(string $email)
    {
        $data = [
            'email' => $email,
        ];
        $url = $this->url . '/' . $this->apiVersion . '/team/user/invite';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->post($url, $data)->json(true));
    }

    /**
     * Disable team member by ID
     *
     * @param $id
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function disableMemberByID($id)
    {
        $url = $this->url . '/' . $this->apiVersion . '/team/user/' . $id . '/disable';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Enable team member by ID
     *
     * @param $id
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function enableMemberByID($id)
    {
        $url = $this->url . '/' . $this->apiVersion . '/team/user/' . $id . '/enable';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Credit Team member by ID
     *
     * @param $id
     * @param $amount
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function creditMemberByID($id, $amount)
    {
        $url = $this->url . '/' . $this->apiVersion . '/team/user/' . $id . '/credit?amount=' . $amount;
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Debit team member by ID
     *
     * @param $id
     * @param $amount
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function debitMemberByID($id, $amount)
    {
        $url = $this->url . '/' . $this->apiVersion . '/team/user/' . $id . '/debit?amount=' . $amount;
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->get($url)->json(true));
    }

    /**
     * Delete team member by ID
     *
     * @param $id
     * @param $amount
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteMemberByID($id, $amount)
    {
        $url = $this->url . '/' . $this->apiVersion . '/team/user/' . $id . '/delete';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->delete($url)->json(true));
    }

    /**
     * Delete invite by ID
     *
     * @param $id
     * @return array|mixed|\stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteInviteByID($id)
    {
        $url = $this->url . '/' . $this->apiVersion . '/team/invitation/' . $id . '/delete';
        $headers = array_merge(Client::JSON_HEADERS, $this->credentials->getAuthHeader());
        return $this->response(Client::withHeaders($headers)->delete($url)->json(true));
    }
}