<?php

namespace UniverseLOL;

use JsonSerializable;
use RelationConfig;

require_once __DIR__ . '/../config/entitiesConfig.php';

class Relation implements JsonSerializable
{
    private $id;
    private $championId;
    private $relatedId;
    private $relationType;
    
    public function __construct($id = null, $championId = null, $relatedId = null, $relationType = null)
    {
        $this->id = $id;
        $this->championId = $championId;
        $this->relatedId = $relatedId;
        $this->relationType = $relationType;
    }

    public function jsonSerialize(): mixed
    {
        return [
            RelationConfig::ID->value => $this->id,
            RelationConfig::CHAMPIONID->value => $this->championId,
            RelationConfig::RELATEDID->value => $this->relatedId,
            RelationConfig::RELATIONTYPE->value => $this->relationType
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

    public function getRelatedId()
    {
        return $this->relatedId;
    }

    public function getRelationType()
    {
        return $this->relationType;
    }
}
