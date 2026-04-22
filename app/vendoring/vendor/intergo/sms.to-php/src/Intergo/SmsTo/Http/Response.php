<?php


namespace Intergo\SmsTo\Http;


use Psr\Http\Message\ResponseInterface;

class Response
{
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function body(): string
    {
        return (string) $this->response->getBody();
    }

    public function json($asArray = true)
    {
        $response = json_decode($this->response->getBody(), $asArray);
        if(empty($response) && $asArray)
        {
            return ['error' => $this->response->getBody()->getContents()];
        }
        if(empty($response) && !$asArray)
        {
            $error = new \stdClass();
            $error->error = $this->response->getBody()->getContents();
            return $error;
        }
        return $response;
    }

    public function header($header): array
    {
        return $this->response->getHeader($header);
    }

    public function headers(): array
    {
        return $this->response->getHeaders();
    }

    public function status(): int
    {
        return $this->response->getStatusCode();
    }

    public function __call($method, $args)
    {
        return $this->response->{$method}(...$args);
    }
}
