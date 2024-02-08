<?php


namespace Intergo\SmsTo\Credentials;


interface ICredential
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return array
     */
    public function verify(): array;

    /**
     * @param string $url
     * @return mixed
     */
    public function setBaseUrl(string $url);

    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return mixed
     */
    public function getExpireTTL();

    /**
     * @return array
     */
    public function getAuthHeader(): array;

    /**
     * @return array
     */
    public function refreshToken(): array;
}