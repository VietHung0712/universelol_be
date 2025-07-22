<?php

namespace UniverseLOL;

use JsonSerializable;
use ModelConfig;

require_once __DIR__ . '/../config/entitiesConfig.php';

class Model implements JsonSerializable
{
    private $id;
    private $championId;
    private $skinId;
    private $model;

    public function __construct($id = null, $championId = null, $skinId = null, $model = null)
    {
        $this->id = $id;
        $this->championId = $championId;
        $this->skinId = $skinId;
        $this->model = $model;
    }

    public function jsonSerialize(): mixed
    {
        return [
            ModelConfig::ID->value => $this->id,
            ModelConfig::CHAMPIONID->value => $this->championId,
            ModelConfig::SKINID->value => $this->skinId,
            ModelConfig::MODEL->value => $this->model
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

    public function getSkinId()
    {
        return $this->skinId;
    }

    public function getModel()
    {
        return $this->model;
    }
}
