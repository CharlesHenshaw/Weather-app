<?php

namespace App\Http\Controllers;

use App\Interfaces\WeatherClientInterface;
use App\Interfaces\WeatherTransformerInterface;
use Illuminate\Routing\ResponseFactory;

class WeatherController extends Controller
{
    /**
     * @var WeatherClientInterface
     */
    private WeatherClientInterface $weatherAppService;

    /**
     * @var WeatherTransformerInterface
     */
    private WeatherTransformerInterface $weatherTransformer;

    public function __construct(
        WeatherClientInterface $weatherAppService,
        WeatherTransformerInterface $weatherTransformer
    ) {
        $this->weatherAppService = $weatherAppService;
        $this->weatherTransformer = $weatherTransformer;
    }

    public function get($location)
    {
        try {
            $apiResult = $this->weatherAppService->getWeather($location);
        } catch (\InvalidArgumentException $error) {
            return response('invalid location', 404);
        }

        return response(
            $this->weatherTransformer->transform($apiResult),
            200
        );
    }
}
