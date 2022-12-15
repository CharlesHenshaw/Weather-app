<?php

namespace App\Interfaces;

interface WeatherClientInterface
{
    public function getWeather(string $location);
}
