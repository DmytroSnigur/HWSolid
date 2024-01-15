<?php
namespace App\GeoCoderSolid;
interface iDistanceCalculator
{
    public function calculateDistance($lat, $lon);
}
