<?php

namespace App\Interfaces;

interface WeatherTransformerInterface
{
    //Transform the result from the open weather api to array
    public function transform($result): array;
}
