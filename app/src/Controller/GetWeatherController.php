<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

require_once('/var/www/html/app/src/secrets.php');
$city = 'rzeszow';

class GetWeatherController extends AbstractController
{
    /**
     * @Route("/getweather/get", name="getweather")
     */
    // public function get(): void
    // {
    //     // return $this->render('getweather/index.html.twig', [
    //     //     'controller_name' => 'GetWeatherController',
    //     // ]);
    // }
}
