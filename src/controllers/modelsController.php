<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../helpers/modelsHelper.php";

try {
    $config = new Config();
    $connect = $config->connect();

    $championId = $_GET['champion'] ?? null;

    if (!$championId || trim($championId) === "") {
        header("Location: ../views/champions.php");
        exit();
    }
    $this_champion = ChampionsHelper::getDataById($connect, $championId, [ChampionConfig::ID->value, ChampionConfig::NAME->value]);

    $modelCols = [
        ModelConfig::ID->value,
        ModelConfig::SKINID->value,
        ModelConfig::MODEL->value
    ];

    $models = modelsHelper::getDataByChampionId($connect, $this_champion->getId(), $modelCols);

    $connect->close();
} catch (\Throwable $th) {
    header("Location: ../views/champions.php");
    exit();
}
