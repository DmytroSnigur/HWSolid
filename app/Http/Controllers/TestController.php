<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeoCoderSolid\GeocoderNominative;
use App\GeoCoderSolid\DistanceCalculatorAndSortingResult;

class TestController extends Controller
{
    protected GeocoderNominative $geocoder;
    protected DistanceCalculatorAndSortingResult $distanceCalculator;
    public function __construct(GeocoderNominative $geocoder, DistanceCalculatorAndSortingResult $distanceCalculator)
    {
        $this->geocoder = $geocoder;
        $this->distanceCalculator = $distanceCalculator;
    }

    public function index(Request $request): void
    {
        $search = 'Продукти Одеса';
        $excludePlaceIds = '';
        $lat = 46.4774700;
        $lon = 30.7326200;

        while (true) {
            $places = $this->geocoder->search($search, $excludePlaceIds);

            foreach ($places as $place) {
                $place->distance = $this->distanceCalculator->calculateDistance($lat, $lon, $place->lat, $place->lon);
            }

            $places = $this->distanceCalculator->sortByDistance($places);
            $places = $this->distanceCalculator->filterAndAddKeys($places);

            if ($excludePlaceIds) {
                dd($places);
            }

            $excludePlaceIds = '&exclude_place_ids=' . urlencode(implode(',', array_keys($places)));
            dump($places);
        }
    }
}
