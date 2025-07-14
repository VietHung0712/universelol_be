<?php

namespace UniverseLOL;

use ChampionConfig;
use JsonSerializable;

require_once __DIR__ . '/../config/entitiesConfig.php';


class Champion implements \JsonSerializable
{
    private $id;
    private $name;
    private $region;
    private $role;
    private $title;
    private $voice;
    private $story;
    private $splashArt;
    private $animatedSplashArt;
    private $positionX;
    private $positionY;
    private $model;
    private $releaseDate;
    private $updatedDate;

    public function __construct($id = null, $name = null, $region = null, $role = null, $title = null, $voice = null, $story = null, $splashArt = null, $animatedSplashArt = null, $positionX = null, $positionY = null, $model = null, $releaseDate = null, $updatedDate = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->region = $region;
        $this->role = $role;
        $this->title = $title;
        $this->voice = $voice;
        $this->story = $story;
        $this->splashArt = $splashArt;
        $this->animatedSplashArt = $animatedSplashArt;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->model = $model;
        $this->releaseDate = $releaseDate;
        $this->updatedDate = $updatedDate;
    }

    public function jsonSerialize(): mixed
    {
        return [
            ChampionConfig::ID->value => $this->id,
            ChampionConfig::NAME->value => $this->name,
            ChampionConfig::REGION->value => $this->region,
            ChampionConfig::ROLE->value => $this->role,
            ChampionConfig::TITLE->value => $this->title,
            ChampionConfig::VOICE->value => $this->voice,
            ChampionConfig::STORY->value => $this->story,
            ChampionConfig::SPLASHART->value => $this->splashArt,
            ChampionConfig::ANIMATEDSPLASHART->value => $this->animatedSplashArt,
            ChampionConfig::POSITIONX->value => $this->positionX,
            ChampionConfig::POSITIONY->value => $this->positionY,
            ChampionConfig::MODEL->value => $this->model,
            ChampionConfig::RELEASEDATE->value => $this->releaseDate instanceof \DateTime ? $this->releaseDate->format('Y-m-d') : $this->releaseDate,
            ChampionConfig::UPDATEDDATE->value => $this->updatedDate instanceof \DateTime ? $this->updatedDate->format('Y-m-d') : $this->updatedDate,
        ];
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getRegion()
    {
        return $this->region;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getVoice()
    {
        return $this->voice;
    }
    public function getStory()
    {
        return $this->story;
    }
    public function getSplashArt()
    {
        return $this->splashArt;
    }
    public function getAnimatedSplashArt()
    {
        return $this->animatedSplashArt;
    }
    public function getPositionX()
    {
        return $this->positionX;
    }
    public function getPositionY()
    {
        return $this->positionY;
    }
    public function getModel()
    {
        return $this->model;
    }
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }
}
