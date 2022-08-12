<?php

namespace App\Util\Http\Services;

interface HttpInterface
{
    public function request(string $method, string $url, array $params = []);
}