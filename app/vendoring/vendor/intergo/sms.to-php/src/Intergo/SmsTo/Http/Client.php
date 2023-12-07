<?php


namespace Intergo\SmsTo\Http;

use GuzzleHttp\Client as HttpClient;

/**
 * @package App\Service\Client
 * Class Client
 *
 * @method static Request asJson()
 * @method static Request asFormParams()
 * @method static Request bodyFormat($format)
 * @method static Request contentType($contentType)
 * @method static Request accept($header)
 * @method static Request withHeaders($headers)
 * @method static Response get($url, $queryParams = [])
 * @method static Response post($url, $params = [])
 * @method static Response patch($url, $params = [])
 * @method static Response put($url, $params = [])
 * @method static Response delete($url, $params = [])
 * @method static Response send($method, $url, $options)
 */
class Client
{
    protected static $client;

    const JSON_HEADERS = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ];

    public static function __callStatic($method, $args)
    {
        return Request::new(static::client())->{$method}(...$args);
    }

    public static function client(): HttpClient
    {
        return static::$client ?: static::$client = new HttpClient(['verify' => false]);
    }
}