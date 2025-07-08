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

    public static function getDataByRegionId(mysqli $connect, $value, array $columns = []): ?array
    {
        $query = Helper::stringQuery(self::getTableConfig(), $columns);
        $newQuery = Helper::stringQueryFind($query, ChampionConfig::REGION->value);
        return Helper::getEntities($connect, self::getClassName(), self::getConfigCases(), $newQuery, $value);
    }

    public static function getDataSortByUpdatedDate(mysqli $connect, array $columns = []): ?array
    {
        $query = Helper::stringQuery(self::getTableConfig(), $columns);
        $newQuery = Helper::stringQuerySort($query, ChampionConfig::UPDATEDDATE->value, false, 5);
        return Helper::getEntities($connect, self::getClassName(), self::getConfigCases(), $newQuery);
    }
}
