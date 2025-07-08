<?php

namespace UniverseLOL;

class Map
{
    private $id;
    private $regionId;
    private $points;

    public function __construct($id, $regionId, $points)
    {
        $this->id = $id;
        $this->regionId = $regionId;
        $this->points = $points;
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
