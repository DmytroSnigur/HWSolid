<?php

namespace App\GeoCoderSolid;

class ResultProcessor implements iResultProcessor
{
    protected $properties = ['place_id', 'name', 'display_name', 'distance'];

    public function filterAndAddKeys($places)
    {
        foreach ($places as $key => $place) {
            foreach ($place as $prop => $val) {
                if (!in_array($prop, $this->properties)) {
                    unset($place->$prop);
                }
            }
            $places[$place->place_id] = $place;
            unset($places[$key]);
        }

        return $places;
    }
}
