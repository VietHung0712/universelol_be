<?php

namespace UniverseLOL;

class Skin
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
