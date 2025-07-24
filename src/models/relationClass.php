<?php

namespace UniverseLOL;

use JsonSerializable;
use RelationConfig;

require_once __DIR__ . '/../config/entitiesConfig.php';

class Relation implements JsonSerializable
{
    private $id;
    private $champion;
    private $related;
    private $relationType;
    
    public function __construct($id = null, $champion = null, $related = null, $relationType = null)
    {
        $this->id = $id;
        $this->champion = $champion;
        $this->related = $related;
        $this->relationType = $relationType;
    }

    public function jsonSerialize(): mixed
    {
        return [
            RelationConfig::ID->value => $this->id,
            RelationConfig::CHAMPION->value => $this->champion,
            RelationConfig::RELATED->value => $this->related,
            RelationConfig::RELATIONTYPE->value => $this->relationType
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

    public function getRelated()
    {
        return $this->related;
    }

    public function getRelationType()
    {
        return $this->relationType;
    }
}
