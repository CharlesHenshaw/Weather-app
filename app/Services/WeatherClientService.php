<?php

namespace App\Services;

use App\Interfaces\WeatherClientInterface;
use GuzzleHttp\Client as GuzzleClient;
use Nette\InvalidArgumentException;

class WeatherClientService implements WeatherClientInterface
{
    private GuzzleClient $weatherClient;

    public function __construct()
    {
        $this->weatherClient = new GuzzleClient();
    }

    public function getWeather(string $location)
    {

        try {
            $request = $this->weatherClient->get(
                sprintf(
                    'https://api.openweathermap.org/data/2.5/weather?q=%s,uk&units=metric&APPID=%s',
                    $location,
                    env('WEATHER_API_KEY')
                )
            );
        } catch (\Throwable $error) {
            throw new InvalidArgumentException();
        }

        return json_decode(
            $request
                ->getBody()
                ->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
    }
}
