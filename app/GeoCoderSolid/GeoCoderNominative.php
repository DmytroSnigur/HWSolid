<?php
namespace App\GeoCoderSolid;
use GuzzleHttp\ClientInterface;

class GeoCoderNominative implements iGeoCoderNominative
{
    const URL = 'https://nominatim.openstreetmap.org/search.php?format=jsonv2&q=';
    private string $excludedPlaceIds;
    private array $places;
    private string $search;
    private ClientInterface $guzzleShmuzzle;
    public function __construct(string $search, ClientInterface $guzzleShmuzzle)
    {
        $this->search = $search;
        $this->guzzleShmuzzle = $guzzleShmuzzle;
    }
    public function setExcludedPlaceIds($excludedPlaceIds)
    {
    $this->excludedPlaceIds = !empty($excludedPlaceIds) ? '&exclude_place_ids='. implode(',', array_keys($excludedPlaceIds)) : '' ;
    return $this;
    }
    public function execute(): array
    {
    $response = $this->guzzleShmuzzle->request('GET', self::URL . urlencode($this->search) . $this->excludedPlaceIds);
    return json_decode($response->getBody()->getContents());
}
}
