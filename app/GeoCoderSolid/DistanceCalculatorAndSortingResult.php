<?php
namespace App\GeoCoderSolid;
class DistanceCalculatorAndSortingResult implements iDistanceCalculator
{
    public function calculateDistance($lat1, $lon1, $lat2, $lon2): float
    {
        return 2 * asin(sqrt(pow(sin(($lat1 - $lat2) / 2), 2) + cos($lat1) * cos($lat2) * pow(sin(($lon1 - $lon2) / 2), 2)));
    }

    public function sortByDistance($places): array
    {
        usort($places, function ($a, $b) {
            return ($a->distance < $b->distance) ? -1 : 1;
        });

        return $places;
    }

    public function filterAndAddKeys($places)
    {
        $properties = ['place_id', 'name', 'display_name', 'distance'];

        foreach ($places as $key => $place) {
            foreach ($place as $prop => $val) {
                if (!in_array($prop, $properties)) {
                    unset($place->$prop);
                }
            }
            $places[$place->place_id] = $place;
            unset($places[$key]);
        }

        return $places;
    }
}
