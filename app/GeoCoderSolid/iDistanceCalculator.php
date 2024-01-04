<?php

namespace App\GeoCoderSolid;
interface iDistanceCalculator
{
    public function calculateDistance($lat1, $lon1, $lat2, $lon2);
}

