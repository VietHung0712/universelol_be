<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../helpers/modelsHelper.php";
require_once __DIR__ . "/../helpers/skinsHelper.php";

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
        ModelConfig::SKIN->value,
        ModelConfig::MODEL->value,
        ModelConfig::POSTER->value
    ];

    $models = ModelsHelper::getDataByChampionId($connect, $this_champion->getId(), $modelCols);
    $skins = SkinsHelper::getDataByChampionId($connect, $championId, [SkinConfig::ID->value, SkinConfig::NAME->value]);
    $getSkinName = [];
    foreach ($skins as $item) {
        $getSkinName[$item->getId()] = $item->getName();
    }

    $connect->close();
} catch (\Throwable $th) {
    header("Location: ../views/champions.php");
    exit();
}
