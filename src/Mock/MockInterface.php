<?php

namespace App\Mock;

interface MockInterface
{
    public function __construct(string $url);

    public function getUrl(): string;

    public function decorate(array $todos): array;
}