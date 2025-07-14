<?php

namespace UniverseLOL;

use JsonSerializable;
use SkinConfig;

require_once __DIR__ . '/../config/entitiesConfig.php';

class Skin implements JsonSerializable
{
    private $id;
    private $championId;
    private $name;
    private $splashArt;

    public function __construct($id = null, $championId = null, $name = null, $splashArt = null)
    {
        $this->id = $id;
        $this->championId = $championId;
        $this->name = $name;
        $this->splashArt = $splashArt;
    }

    public function jsonSerialize(): mixed
    {
        return [
            SkinConfig::ID->value => $this->id,
            SkinConfig::NAME->value => $this->name,
            SkinConfig::CHAMPIONID->value => $this->championId,
            SkinConfig::SPLASHART->value => $this->splashArt
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getChampionId()
    {
        return $this->championId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSplashArt()
    {
        return $this->splashArt;
    }

}
