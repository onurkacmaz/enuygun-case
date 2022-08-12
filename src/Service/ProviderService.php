<?php

namespace App\Service;

use App\Entity\ToDo;
use App\Mock\Mock1;
use App\Mock\Mock2;
use App\Mock\Mock3;
use App\Provider\Provider;
use App\Repository\ToDoRepository;
use App\Support\Planner;
use App\Util\Http\Services\Curl;
use App\Util\Http\Services\Guzzle;
use DateTime;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ProviderService
{
    public function __construct(
        public ParameterBagInterface $parameterBag,
        public ToDoRepository $toDoRepository,
        public Planner $planner
    ){}

    public function importTodos(): void {
        $mock1 = new Mock1("https://www.mocky.io/v2/5d47f24c330000623fa3ebfa");
        $mock2 = new Mock2("https://www.mocky.io/v2/5d47f235330000623fa3ebf7");
        //$mock3 = new Mock3("https://jsonplaceholder.typicode.com/todos");

        $todos = array_merge(
            (new Provider($mock1, new Guzzle()))->getData(),
            (new Provider($mock2, new Curl()))->getData(),
            //(new Provider($mock3, new Curl()))->getData(),
        );

        $countOfTodos = count($todos) - 1;

        foreach ($todos as $key => $todo) {
            $todoEntity = new ToDo();
            $todoEntity->setTitle($todo["title"]);
            $todoEntity->setDifficulty($todo["difficulty"]);
            $todoEntity->setDuration($todo["duration"]);
            $todoEntity->setCreatedAt(new DateTime());

            $this->toDoRepository->add($todoEntity, $key === $countOfTodos);
        }
    }
}