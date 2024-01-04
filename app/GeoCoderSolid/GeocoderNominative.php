<?php
namespace App\GeoCoderSolid;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class GeocoderNominative implements iGeocoderNominative
{ // класс для реализации интерфейса и для запросов к API
    protected string $url = 'https://nominatim.openstreetmap.org/search.php?format=jsonv2&q=';

    public function search($query, $exclude_place_ids)
    {
        try {
            $guzzleClient = new GuzzleClient();
            $response = $guzzleClient->request('GET', $this->url . urlencode($query) . $exclude_place_ids);
            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            echo 'Guzzle Exception: ' . $e->getMessage();
            return null;
        }
    }
}

