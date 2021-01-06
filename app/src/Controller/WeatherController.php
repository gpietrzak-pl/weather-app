<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    /**
     * @Route("/weather", name="weather")
     */
    public function index(): Response
    {
        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
        ]);
    }

    /**
     * @Route("/weather/now/{city?}", name="weather")
     */
    public function now() : Response
    {
        dump

        return $this->json([
            'message' => 'Hello in actual weather',
        ]);
    }
}
