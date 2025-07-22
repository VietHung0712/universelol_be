<?php

namespace UniverseLOL;

use JsonSerializable;
use RegionGalleryConfig;

require_once __DIR__ . '/../config/entitiesConfig.php';

class RegionGallery implements JsonSerializable
{
    private $id;
    private $regionId;
    private $gallery;
    
    public function __construct($id = null, $regionId = null, $gallery = null)
    {
        $this->id = $id;
        $this->regionId = $regionId;
        $this->gallery = $gallery;
    }

    public function jsonSerialize(): mixed
    {
        return [
            RegionGalleryConfig::ID->value => $this->id,
            RegionGalleryConfig::REGIONID->value => $this->regionId,
            RegionGalleryConfig::GALLERY->value => $this->gallery,
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

    public function getGallery()
    {
        return $this->gallery;
    }
}
