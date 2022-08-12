<?php

namespace App\Support;

use App\Repository\ToDoRepository;

class Planner
{
    public const WEEKLY_WORKING_HOURS = 45;

    public function __construct(public ToDoRepository $toDoRepository){}

    public function getPlan(): array
    {
        $developers = [
            "5" => [
                "name" => "DEV5",
                "todos" => []
            ],
            "4" => [
                "name" => "DEV4",
                "todos" => []
            ],
            "3" => [
                "name" => "DEV3",
                "todos" => []
            ],
            "2" => [
                "name" => "DEV2",
                "todos" => []
            ],
            "1" => [
                "name" => "DEV1",
                "todos" => []
            ],
        ];

        $todos = $this->toDoRepository->getAllTodos();

        foreach ($todos as $todo) {
            if ($todo->getDifficulty() === 5) {
                $developers["5"]["todos"][] = $todo;
            }
            if ($todo->getDifficulty() === 4) {
                $developers["4"]["todos"][] = $todo;
            }
            if ($todo->getDifficulty() === 3) {
                $developers["3"]["todos"][] = $todo;
            }
            if ($todo->getDifficulty() === 2) {
                $developers["2"]["todos"][] = $todo;
            }
            if ($todo->getDifficulty() === 1) {
                $developers["1"]["todos"][] = $todo;
            }
        }

        foreach ($developers as $key => $developer) {
            $totalDuration = 0;
            foreach ($developer["todos"] as $todo) {
                $totalDuration += $todo->getDuration();
                $developers[$key]["totalWeek"] = round($totalDuration / self::WEEKLY_WORKING_HOURS);
            }
        }
        return $developers;
    }
}