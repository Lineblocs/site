<?php


namespace Intergo\SmsTo\Http;


use GuzzleHttp\Client;

class Request
{
    /**
     * @var Client
     */
    private $client;

    private $bodyFormat;

    private $options;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->bodyFormat = 'json';
        $this->options = [
            'http_errors' => false,
        ];
    }

    public static function new(...$args): Request
    {
        return new self(...$args);
    }

    public function asJson()
    {
        return $this->bodyFormat('json')->contentType('application/json');
    }

    public function asFormParams()
    {
        return $this->bodyFormat('form_params')->contentType('application/x-www-form-urlencoded');
    }

    public function bodyFormat($format)
    {
        return $this->tap($this, function ($request) use ($format) {
            $this->bodyFormat = $format;
        });
    }

    public function contentType($contentType)
    {
        return $this->withHeaders(['Content-Type' => $contentType]);
    }

    public function accept($header)
    {
        return $this->withHeaders(['Accept' => $header]);
    }

    public function withHeaders($headers)
    {
        return $this->tap($this, function ($request) use ($headers) {
            return $this->options = array_merge_recursive($this->options, [
                'headers' => $headers
            ]);
        });
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($url, $queryParams = []): Response
    {
        return $this->send('GET', $url, [
            'query' => $queryParams,
        ]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($url, $params = []): Response
    {
        return $this->send('POST', $url, [
            $this->bodyFormat => $params,
        ]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function patch($url, $params = []): Response
    {
        return $this->send('PATCH', $url, [
            $this->bodyFormat => $params,
        ]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put($url, $params = []): Response
    {
        return $this->send('PUT', $url, [
            $this->bodyFormat => $params,
        ]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($url, $params = []): Response
    {
        return $this->send('DELETE', $url, [
            $this->bodyFormat => $params,
        ]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($method, $url, $options): Response
    {
        return new Response($this->client->request($method, $url, $this->mergeOptions([
            'query' => $this->parseQueryParams($url),
        ], $options)));
    }

    protected function mergeOptions(...$options): array
    {
        return array_merge_recursive($this->options, ...$options);
    }

    protected function parseQueryParams($url)
    {
        return $this->tap([], function (&$query) use ($url) {
            parse_str(parse_url($url, PHP_URL_QUERY), $query);
        });
    }

    private function tap($value, $callback)
    {
        $callback($value);

        return $value;
    }
}