<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../../login.php");
    exit();
}

use UniverseLOL\Champion;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../helpers/regionsHelper.php";

try {
    $cols = [
        ChampionConfig::ID->value,
        ChampionConfig::NAME->value,
        ChampionConfig::REGION->value,
        ChampionConfig::RELEASEDATE->value,
        ChampionConfig::UPDATEDDATE->value
    ];
    $config = new Config();
    $connect = $config->connect();
    $champions = ChampionsHelper::getData($connect, $cols);
    $sortArr = [
        ['az', 'A->Z'],
        ['newest', 'Newest'],
        ['updated', 'Updated'],
        ['region', 'Region']
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $valueSort = $_POST['sort'] ?? '';
        $valueSearch = $_POST['valueSearch'];
        $value = '%' . $valueSearch . '%';
        $asc = true;

        if ($valueSort == 'az') {
            $sort = ChampionConfig::ID->value;
        } else if ($valueSort == 'newest') {
            $sort = ChampionConfig::RELEASEDATE->value;
            $asc = false;
        } else if ($valueSort == 'updated') {
            $sort = ChampionConfig::UPDATEDDATE->value;
            $asc = false;
        } else if ($valueSort == 'region') {
            $sort = ChampionConfig::REGION->value;
        }

        $query = Helper::stringQuery(TableName::CHAMPION->value, $cols);
        $query = Helper::stringQuerySearch($query, ChampionConfig::ID->value);
        $query = Helper::stringQuerySort($query, $sort, $asc);
        $champions = Helper::getEntities($connect, Champion::class, ChampionConfig::cases(), $query, $value);
    }
    $connect->close();
} catch (\Throwable $th) {
    header("Location: ../views/index.php");
    exit();
}
