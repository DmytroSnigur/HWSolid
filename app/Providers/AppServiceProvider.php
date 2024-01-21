<?php

namespace App\Providers;

use App\GeoCoderSolid\DistanceCalculator;
use App\GeoCoderSolid\GeoCoderNominative;
use App\GeoCoderSolid\iDistanceCalculator;
use App\GeoCoderSolid\iGeoCoderNominative;
use App\GeoCoderSolid\iResultProcessor;
use App\GeoCoderSolid\ResultProcessor;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(iDistanceCalculator::class, DistanceCalculator::class);
        $con = $this->app->when(DistanceCalculator::class);
        $con->needs('$lat')->give(46.4774700);
        $con->needs('$lon')->give(30.7326200);

        $this->app->bind(iGeoCoderNominative::class, GeoCoderNominative::class);
        $con = $this->app->when(GeoCoderNominative::class);
        $con->needs('$search')->give('Продукти Одеса');

        $this->app->bind(iResultProcessor::class, ResultProcessor::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
    }
}

