<?php

namespace UniverseLOL;

use JsonSerializable;
use RoleConfig;

require_once __DIR__ . '/../config/entitiesConfig.php';

class Role implements JsonSerializable
{
    private $id;
    private $name;
    private $icon;

    public function __construct($id = null, $name = null, $icon = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
    }

    public function jsonSerialize(): mixed
    {
        return [
            RoleConfig::ID->value => $this->id,
            RoleConfig::NAME->value => $this->name,
            RoleConfig::ICON->value => $this->icon
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

    public function getIcon()
    {
        return $this->icon;
    }
}
