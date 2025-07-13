<?php

namespace UniverseLOL;

class Role
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
