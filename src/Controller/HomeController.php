<?php

namespace App\Controller;

use App\Support\Planner;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/', methods: ['GET'])]
    public function index(Planner $planner): Response
    {
        $plan = $planner->getPlan();

        return $this->render('home.html.twig', [
            "plan" => $plan,
        ]);
    }
}