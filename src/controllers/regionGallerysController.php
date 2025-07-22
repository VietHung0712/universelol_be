<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/regionsHelper.php";
require_once __DIR__ . "/../helpers/regionGallerysHelper.php";

try {
    $config = new Config();
    $connect = $config->connect();

    $regionId = $_GET['region'] ?? null;

    if (!$regionId || trim($regionId) === "") {
        header("Location: ../views/regions.php");
        exit();
    }
    $this_region = RegionsHelper::getDataById($connect, $regionId, [RegionConfig::ID->value, RegionConfig::NAME->value]);
    $cols = [
        RegionGalleryConfig::ID->value,
        RegionGalleryConfig::REGIONID->value,
        RegionGalleryConfig::GALLERY->value
    ];

    $regionGallerys = RegionGallerysHelper::getDataByRegionId($connect, $this_region->getId(), $cols);

    $connect->close();
} catch (\Throwable $th) {
    header("Location: ../views/regions.php");
    exit();
}
