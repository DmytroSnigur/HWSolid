<?php
namespace App\GeoCoderSolid;
class DistanceCalculator implements iDistanceCalculator
{
    private $lat;
    private $lon;
    public function __construct($lat = 46.4774700, $lon = 30.7326200) {
        $this->lat = $lat;
        $this->lon = $lon;
    }
    public function calculateDistance($lat, $lon)  {
        return 2 * asin(sqrt(pow(sin(($this->lat - $lat) / 2), 2) + cos($this->lat) * cos($lat) * pow(sin(($this->lon - $lon) / 2), 2)));
    }
}
