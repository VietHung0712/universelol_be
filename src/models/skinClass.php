<?php

namespace UniverseLOL;

use JsonSerializable;
use SkinConfig;

require_once __DIR__ . '/../config/entitiesConfig.php';

class Skin implements JsonSerializable
{
    private $id;
    private $champion;
    private $name;
    private $splashArt;

    public function __construct($id = null, $champion = null, $name = null, $splashArt = null)
    {
        $this->id = $id;
        $this->champion = $champion;
        $this->name = $name;
        $this->splashArt = $splashArt;
    }

    public function jsonSerialize(): mixed
    {
        return [
            SkinConfig::ID->value => $this->id,
            SkinConfig::NAME->value => $this->name,
            SkinConfig::CHAMPION->value => $this->champion,
            SkinConfig::SPLASHART->value => $this->splashArt
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getChampion()
    {
        return $this->champion;
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
