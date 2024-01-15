<?php
namespace App\GeoCoderSolid;

interface iGeoCoderNominative
{
    public function setExcludedPlaceIds($excludedPlaceIds);
    public function execute();
}
