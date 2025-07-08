<?php
require_once __DIR__ . "/../helpers/helper.php";

abstract class EntityHelper
{
    public static function getData(mysqli $connect, array $columns = []): array
    {
        $query = Helper::stringQuery(static::getTableConfig(), $columns);
        return Helper::getEntities($connect, static::getClassName(), static::getConfigCases(), $query);
    }

    public static function getDataById(mysqli $connect, $value, array $columns = []): ?object
    {
        $query = Helper::stringQuery(static::getTableConfig(), $columns);
        $queryFind = Helper::stringQueryFind($query, static::getIdConfig());
        return Helper::getEntities($connect, static::getClassName(), static::getConfigCases(), $queryFind, $value)[0];
    }


    public static function checkExists(mysqli $connect, string $value)
    {
        return Helper::checkExists($connect, static::getTableConfig(), static::getIdConfig(), $value);
    }

    public static function addData(mysqli $connect, array $data)
    {
        return Helper::addData($connect, static::getTableConfig(), $data);
    }

    public static function deleteData(mysqli $connect, string $value)
    {
        return Helper::deleteData($connect, static::getTableConfig(), static::getIdConfig(), $value);
    }

    public static function updateData(mysqli $connect, array $data, string $value)
    {
        return Helper::updateData($connect, static::getTableConfig(), $data, static::getIdConfig(), $value);
    }

    abstract protected static function getTableConfig(): string;
    abstract protected static function getClassName(): string;
    abstract protected static function getConfigCases(): array;
    abstract protected static function getIdConfig(): string;
}
