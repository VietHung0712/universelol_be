<?php

namespace UniverseLOL;

use RegionConfig;
use JsonSerializable;

require_once __DIR__ . '/../config/entitiesConfig.php';

class Region implements \JsonSerializable
{
    private $id;
    private $name;
    private $title;
    private $story;
    private $icon;
    private $avatar;
    private $background;
    private $animatedBackground;

    public function __construct($id = null, $name = null, $title = null, $story = null, $icon = null, $avatar = null, $background = null, $animatedBackground = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->story = $story;
        $this->icon = $icon;
        $this->avatar = $avatar;
        $this->background = $background;
        $this->animatedBackground = $animatedBackground;
    }

    public function jsonSerialize(): mixed
    {
        return [
            RegionConfig::ID->value => $this->id,
            RegionConfig::NAME->value => $this->name,
            RegionConfig::TITLE->value => $this->title,
            RegionConfig::STORY->value => $this->story,
            RegionConfig::ICON->value => $this->icon,
            RegionConfig::AVATAR->value => $this->avatar,
            RegionConfig::BACKGROUND->value => $this->background,
            RegionConfig::ANIMATEDBACKGROUND->value => $this->animatedBackground
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

    public function getTitle()
    {
        return $this->title;
    }

    public function getStory()
    {
        return $this->story;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getBackground()
    {
        return $this->background;
    }

    public function getAnimatedBackground()
    {
        return $this->animatedBackground;
    }
}
