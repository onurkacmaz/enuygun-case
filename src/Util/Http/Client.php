<?php

namespace App\Util\Http;

use App\Util\Http\Services\HttpInterface;
use Symfony\Component\HttpFoundation\Response;

class Client
{
    private HttpInterface $client;

    public function __construct(HttpInterface $client)
    {
        $this->client = $client;
    }

    public function request(string $method, string $url, array $params = []): Response {
        return $this->client->request(method: $method, url: $url, params: $params);
    }
}