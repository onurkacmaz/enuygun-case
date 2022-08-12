<?php

namespace App\Mock;

class Mock2 implements MockInterface
{
    public function __construct(protected string $url){}

    public function getUrl(): string
    {
        return $this->url;
    }

    public function decorate(array $todos): array {
        foreach ($todos as $key => $todo) {
            unset($todos[$key]);
            $todoKey = array_key_first($todo);
            $todos[] = [
                'title' => $todoKey,
                'duration' => $todo[$todoKey]['estimated_duration'],
                'difficulty' => $todo[$todoKey]['level']
            ];
        }

        return $todos;
    }
}