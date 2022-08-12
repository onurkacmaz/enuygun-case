<?php

namespace App\Mock;

class Mock3 implements MockInterface
{
    public function __construct(protected string $url){}

    public function getUrl(): string
    {
        return $this->url;
    }

    public function decorate(array $todos): array {
        foreach ($todos as $key => $todo) {
            $todos[$key] = [
                'title' => $todo["title"],
                'duration' => 1,
                'difficulty' => 1
            ];
        }

        return $todos;
    }
}