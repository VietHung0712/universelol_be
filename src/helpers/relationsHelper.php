<?php
require_once __DIR__ . '/../Models/relationClass.php';
require_once __DIR__ . "/../config/entitiesConfig.php";
require_once __DIR__ . "/../helpers/abstract.php";

use UniverseLOL\Relation;

class RelationsHelper extends EntityHelper
{
    protected static function getTableConfig(): string
    {
        return TableName::RELATION->value;
    }

    protected static function getClassName(): string
    {
        return Relation::class;
    }

    protected static function getConfigCases(): array
    {
        return RelationConfig::cases();
    }

    protected static function getIdConfig(): string
    {
        return RelationConfig::ID->value;
    }

    public static function getDataByChampionId(mysqli $connect, $value, array $columns = []): ?array
    {
        $query = Helper::stringQuery(self::getTableConfig(), $columns);
        $queryFind = Helper::stringQueryFind($query, RelationConfig::CHAMPION->value);
        return Helper::getEntities($connect, self::getClassName(), self::getConfigCases(), $queryFind, $value);
    }
}
