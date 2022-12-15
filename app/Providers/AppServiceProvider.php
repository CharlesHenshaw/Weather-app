<?php

namespace App\Providers;

use App\Interfaces\WeatherClientInterface;
use App\Interfaces\WeatherTransformerInterface;
use App\Services\WeatherClientService;
use App\Transformers\WeatherTransformer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(WeatherClientInterface::class, WeatherClientService::class);
        $this->app->bind(WeatherTransformerInterface::class, WeatherTransformer::class);
    }
}
