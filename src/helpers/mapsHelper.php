<?php
require_once __DIR__ . '/../Models/mapClass.php';
require_once __DIR__ . "/../config/entitiesConfig.php";
require_once __DIR__ . "/../helpers/abstract.php";

use UniverseLOL\Map;

class MapsHelper extends EntityHelper
{
    protected static function getTableConfig(): string
    {
        return TableName::MAP->value;
    }

    protected static function getClassName(): string
    {
        return Map::class;
    }

    protected static function getConfigCases(): array
    {
        return MapConfig::cases();
    }

    protected static function getIdConfig(): string
    {
        return MapConfig::ID->value;
    }

    public static function getMapsForRegion(mysqli $connect): array
    {
        $arr = self::getData($connect);
        $result = [];
        foreach ($arr as $item) {
            $regionId = $item->getRegionId();
            $points = trim($item->getPoints());
            if (!isset($result[$regionId])) {
                $result[$regionId] = [];
            }
            $result[$regionId][] = $points;
        }
        return $result;
    }
}
