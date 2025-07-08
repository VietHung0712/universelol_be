<?php
require_once __DIR__ . '/../Models/regionClass.php';
require_once __DIR__ . "/../config/entitiesConfig.php";
require_once __DIR__ . "/../helpers/abstract.php";

use UniverseLOL\Region;

class RegionsHelper extends EntityHelper
{
    protected static function getTableConfig(): string
    {
        return TableName::REGION->value;
    }

    protected static function getClassName(): string
    {
        return Region::class;
    }

    protected static function getConfigCases(): array
    {
        return RegionConfig::cases();
    }

    protected static function getIdConfig(): string
    {
        return RegionConfig::ID->value;
    }

    public static function getNameAllRegions(mysqli $connect): array
    {
        $cols = [
            RegionConfig::ID->value,
            RegionConfig::NAME->value
        ];
        $result = [];
        $arr = self::getData($connect, $cols);
        foreach ($arr as $item) {
            $result[$item->getId()] = $item->getName();
        }
        return $result;
    }
}
