<?php

namespace UniverseLOL;

use JsonSerializable;
use RegionGalleryConfig;

require_once __DIR__ . '/../config/entitiesConfig.php';

class RegionGallery implements JsonSerializable
{
    private $id;
    private $region;
    private $gallery;
    
    public function __construct($id = null, $region = null, $gallery = null)
    {
        $this->id = $id;
        $this->region = $region;
        $this->gallery = $gallery;
    }

    public function jsonSerialize(): mixed
    {
        return [
            RegionGalleryConfig::ID->value => $this->id,
            RegionGalleryConfig::REGION->value => $this->region,
            RegionGalleryConfig::GALLERY->value => $this->gallery,
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getGallery()
    {
        return $this->gallery;
    }
}
