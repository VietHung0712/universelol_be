<?php
require_once __DIR__ . '/../Models/modelClass.php';
require_once __DIR__ . "/../config/entitiesConfig.php";
require_once __DIR__ . "/../helpers/abstract.php";

use UniverseLOL\Model;

class ModelsHelper extends EntityHelper
{
    protected static function getTableConfig(): string
    {
        return TableName::MODEL->value;
    }

    protected static function getClassName(): string
    {
        return Model::class;
    }

    protected static function getConfigCases(): array
    {
        return ModelConfig::cases();
    }

    protected static function getIdConfig(): string
    {
        return ModelConfig::ID->value;
    }

    public static function getDataByChampionId(mysqli $connect, $value, array $columns = []): ?array
    {
        $query = Helper::stringQuery(self::getTableConfig(), $columns);
        $queryFind = Helper::stringQueryFind($query, ModelConfig::CHAMPION->value);
        return Helper::getEntities($connect, self::getClassName(), self::getConfigCases(), $queryFind, $value);
    }
}
