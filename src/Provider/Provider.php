<?php

namespace App\Provider;

use App\Mock\MockInterface;
use App\Util\Http\Client;
use App\Util\Http\Services\HttpInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class Provider
{
    private MockInterface $mock;
    private Client $http;

    public function __construct(MockInterface $mock, HttpInterface $http)
    {
        $this->mock = $mock;
        $this->http = new Client($http);
    }

    public function getUrl(): string
    {
        return $this->mock->getUrl();
    }

    public function getData(): array {
        try {
            $response = $this->http->request(method: Request::METHOD_GET, url: $this->getUrl());
        } catch (Exception) {
            return [];
        }

        return $this->mock->decorate(
            todos: json_decode(json: $response->getContent(), associative: true)
        );
    }
}