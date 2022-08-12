<?php

namespace App\Mock;

class Mock1 implements MockInterface
{
    public function __construct(protected string $url){}

    public function getUrl(): string
    {
        return $this->url;
    }

    public function decorate(array $todos): array {
        foreach ($todos as $key => $todo) {
            $todos[$key] = [
                'title' => $todo['id'],
                'duration' => $todo['sure'],
                'difficulty' => $todo['zorluk']
            ];
        }

        return $todos;
    }
}