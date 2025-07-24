<?php
require_once __DIR__ . '/../models/regionGalleryClass.php';
require_once __DIR__ . "/../config/entitiesConfig.php";
require_once __DIR__ . "/../helpers/abstract.php";

use UniverseLOL\regionGallery;

class RegionGallerysHelper extends EntityHelper
{
    protected static function getTableConfig(): string
    {
        return TableName::REGIONGALLERY->value;
    }

    protected static function getClassName(): string
    {
        return RegionGallery::class;
    }

    protected static function getConfigCases(): array
    {
        return RegionGalleryConfig::cases();
    }

    protected static function getIdConfig(): string
    {
        return RegionGalleryConfig::ID->value;
    }

    public static function getDataByRegionId(mysqli $connect, $value, array $columns = []): ?array
    {
        $query = Helper::stringQuery(self::getTableConfig(), $columns);
        $queryFind = Helper::stringQueryFind($query, RegionGalleryConfig::REGION->value);
        return Helper::getEntities($connect, self::getClassName(), self::getConfigCases(), $queryFind, $value);
    }
}
