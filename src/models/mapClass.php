<?php

namespace UniverseLOL;

use JsonSerializable;
use MapConfig;

require_once __DIR__ . '/../config/entitiesConfig.php';

class Map implements JsonSerializable
{
    private $id;
    private $regionId;
    private $points;

    public function __construct($id = null, $regionId = null, $points = null)
    {
        $this->id = $id;
        $this->regionId = $regionId;
        $this->points = $points;
    }

    public function jsonSerialize(): mixed
    {
        return [
            MapConfig::ID->value => $this->id,
            MapConfig::REGIONID->value => $this->regionId,
            MapConfig::POINTS->value => $this->points,
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRegionId()
    {
        return $this->regionId;
    }

    public function getPoints()
    {
        return $this->points;
    }
}
