<?php

namespace App\GeoCoderSolid;
interface iGeocoderNominative
{
    public function search($query, $exclude_place_ids); //интерфейс Геокодер
}
