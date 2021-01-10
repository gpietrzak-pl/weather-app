<?php 

namespace App\Entity;

use App\Repository\WeatherRepository;
use Doctrine\ORM\Mapping as ORM;



class Weather
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="DateTime")
     */
    private $pubDate;

    /**
     * @ORM\Column(type="strign")
     */
    private $location;

    /**
     * @ORM\Column(type="integer")
     */
    private $windChill;

    /**
     * @ORM\Column(type="integer")
     */
    private $windDirection;

    /**
     * @ORM\Column(type="decimal", precision="5", scale="2")
     */
    private $windSpeed;

    /**
     * @ORM\Column(type="integer")
     */
    private $humidity;

    /**
     * @ORM\Column(type="integer")
     */
    private $visibility;

    /**
     * @ORM\Column(type="decimal", precision="5", scale="2")
     */
    private $pressure;

    /**
     * @ORM\Column(type="integer")
     */
    private $condition;

    /**
     * @ORM\Column(type="integer")
     */
    private $temperature;

    public getWeather()
    {
        this->json([$id, $pubDate, $location, $temperature, $windChill, $windDirection, $windSpeed, $humidity, $visibility, $pressure, $condition, $temperature]};
        return this;
    }

}

