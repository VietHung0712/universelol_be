<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/regionsHelper.php";

try {
    $config = new Config();
    $connect = $config->connect();
    $cols = [
        RegionConfig::ID->value,
        RegionConfig::NAME->value
    ];
    $regions = RegionsHelper::getData($connect, $cols);

    $connect->close();
} catch (\Throwable $th) {
    header("Location: ../views/index.php");
    exit();
}
