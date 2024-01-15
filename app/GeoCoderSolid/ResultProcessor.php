<?php
namespace App\GeoCoderSolid;
class ResultProcessor implements iResultProcessor
{
    const PROPERTIES = ['place_id', 'name', 'display_name', 'distance'];
    private iGeoCoderNominative $guzzleShmuzzle;
    private $places;
    private iDistanceCalculator $distance;
    public function __construct(iGeoCoderNominative $guzzleShmuzzle, iDistanceCalculator $distance)
    {
        $this->guzzleShmuzzle = $guzzleShmuzzle;
        $this->distance = $distance;
    }

    public function perform()
    {
        $this->searchPlaces();
        $this->setDistance();
        $this->sortByDistance();
        $this->filterPlaces();
        $this->placeIdToArrayKey();

        return $this->places;
    }

    protected function searchPlaces(): void
    {
        $this->places = $this->guzzleShmuzzle->setExcludedPlaceIds($this->places)->execute();
    }

    protected function filterPlaces(): void
    {
        foreach ($this->places as $key => $place) {
            foreach ($place as $prop => $val) {
                if (!in_array($prop, self::PROPERTIES)) {
                    unset($place->$prop);
                }
            }
            $places[$place->place_id] = $place;
            unset($places[$key]);
        }
    }

    protected function placeIdToArrayKey(): void
    {
        foreach ($this->places as $key => $place) {
            $this->places[$place->place_id] = $place;
            unset($this->places[$key]);
        }
    }

    protected function sortByDistance(): void
    {
        usort($this->places, function ($a, $b) {
            return ($a->distance < $b->distance) ? -1 : 1;
        });
    }

    protected function setDistance(): void
    {
        foreach ($this->places as $place) {
            $place->distance = $this->distance->calculateDistance($place->lat, $place->lon);
        }
    }
}

