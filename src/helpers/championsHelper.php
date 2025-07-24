<?php
require_once __DIR__ . '/../Models/championClass.php';
require_once __DIR__ . "/../config/entitiesConfig.php";
require_once __DIR__ . "/../helpers/abstract.php";

use UniverseLOL\Champion;

class ChampionsHelper extends EntityHelper
{
    protected static function getTableConfig(): string
    {
        return TableName::CHAMPION->value;
    }

    protected static function getClassName(): string
    {
        return Champion::class;
    }

    protected static function getConfigCases(): array
    {
        return ChampionConfig::cases();
    }

    protected static function getIdConfig(): string
    {
        return ChampionConfig::ID->value;
    }
}
