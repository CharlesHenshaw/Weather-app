<?php

namespace App\Transformers;

use App\Interfaces\WeatherTransformerInterface;

class WeatherTransformer implements WeatherTransformerInterface
{
    public function transform($result): array
    {
        $icon = $result['weather'][0]['icon'] ?? '';
        return [
            'location' => $result['name'] ?? '',
            'weather_headline' => $result['weather'][0]['main'] ?? '',
            'weather_description' => $result['weather'][0]['description'] ?? '',
            'icon_url' => sprintf('http://openweathermap.org/img/w/%s.png', $icon),
            'true_temp' => floor($result['main']['temp']) ?? 0,
            'feel_like_temp' => floor($result['main']['feels_like']) ?? 0,
        ];
    }
}
