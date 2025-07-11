<?php

namespace UniverseLOL;

class Relation
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
