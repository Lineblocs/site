<?php


namespace Intergo\SmsTo\Credentials;


use DateInterval;
use DateTime;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Intergo\SmsTo\Http\Client;

class OauthCredential implements ICredential
{
    /**
     * @var string
     */
    private $type = 'oauth';

    /**
     * @var string
     */
    private $url = 'https://auth.sms.to';

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var int|null
     */
    private $expiresIn;

    /**
     * Offset in seconds
     *
     * @var int|null
     */
    private $autoRefreshOffset;

    /**
     * @var DateTime
     */
    private $expireTS;

    /**
     * @var string
     */
    private $accessToken = '';

    /**
     * OauthCredential constructor.
     * @param string $clientId
     * @param string $secret
     * @param null $expiresIn
     * @param bool $enableAutoRefresh
     * @param $autoRefreshOffset
     */
    public function __construct(string $clientId, string $secret, $expiresIn = null, bool $enableAutoRefresh = false, $autoRefreshOffset = null)
    {
        $this->clientId = $clientId;
        $this->secret = $secret;
        $this->expiresIn = (int)$expiresIn;
        if ($enableAutoRefresh) {
            $this->autoRefreshOffset = $this->expiresIn == 1 ? 30 : $autoRefreshOffset ?? 60;
        }
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Verify if ClientID and Secret are valid
     *
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function verify(): array
    {
        if ($this->accessToken) {
            return [
                'jwt' => $this->accessToken,
                'expires' => $this->expiresIn,
                'token_type' => 'bearer',
            ];
        }
        $url = $this->url . '/oauth/token';
        $credentials = [
            'client_id' => $this->clientId,
            'secret' => $this->secret,
            'expires_in' => $this->expiresIn,
        ];
        $response = Client::withHeaders(Client::JSON_HEADERS)->post($url, $credentials)->json(true);
        if (!isset($response['jwt'])) {
            throw new Exception($response['message']);
        }
        $this->accessToken = $response['jwt'];
        $now = new DateTime();
        $expiresIn = $this->expiresIn;
        $this->expireTS = $now->add(new DateInterval("P0DT0H${expiresIn}M0S"));
        return $response;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @return array|string[]
     * @throws GuzzleException
     */
    public function getAuthHeader(): array
    {
        if (empty($this->accessToken)) {
            return [];
        }
        if ($this->autoRefreshOffset && $this->expireTS) {
            $now = new DateTime();
            $diff = $now->diff($this->expireTS)->s;
            if ($diff > 0 && $diff <= $this->autoRefreshOffset) {
                $this->refreshToken();
            }
        }
        return $this->getHeaders();
    }

    private function getHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->accessToken,
            'X-Smsto-Sdk' => $this->accessToken,
        ];
    }

    /**
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function refreshToken(): array
    {
        $url = $this->url . '/refresh';
        $headers = Client::JSON_HEADERS;
        $headers = array_merge($headers, $this->getHeaders());
        $response = Client::withHeaders($headers)->post($url)->json(true);
        if (!isset($response['jwt'])) {
            throw new Exception($response['message']);
        }
        $this->accessToken = $response['jwt'];
        $now = new DateTime();
        $expiresIn = $this->expiresIn;
        $this->expireTS = $now->add(new DateInterval("P0DT0H${expiresIn}M0S"));
        return $response;
    }

    /**
     * @return int|null
     */
    public function getExpireTTL()
    {
        return $this->expiresIn;
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