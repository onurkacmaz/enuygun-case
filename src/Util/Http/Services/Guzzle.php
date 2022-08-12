<?php

namespace App\Util\Http\Services;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class Guzzle implements HttpInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function request(string $method, string $url, array $params = []): Response
    {
        $response = $this->client->request($method, $url, $params);
        return new Response($response->getBody()->getContents(), $response->getStatusCode(), $response->getHeaders());
    }
}