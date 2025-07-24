<?php

namespace UniverseLOL;

use JsonSerializable;
use ModelConfig;

require_once __DIR__ . '/../config/entitiesConfig.php';

class Model implements JsonSerializable
{
    private $id;
    private $champion;
    private $skin;
    private $model;
    private $poster;

    public function __construct($id = null, $champion = null, $skin = null, $model = null, $poster = null)
    {
        $this->id = $id;
        $this->champion = $champion;
        $this->skin = $skin;
        $this->model = $model;
        $this->poster = $poster;
    }

    public function jsonSerialize(): mixed
    {
        return [
            ModelConfig::ID->value => $this->id,
            ModelConfig::CHAMPION->value => $this->champion,
            ModelConfig::SKIN->value => $this->skin,
            ModelConfig::MODEL->value => $this->model,
            ModelConfig::POSTER->value => $this->poster
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

    public function getSkin()
    {
        return $this->skin;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getPoster() {
        return $this->poster;
    }
}
