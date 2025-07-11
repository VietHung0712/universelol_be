<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../helpers/relationsHelper.php";

$config = new Config();
$connect = $config->connect();

$championId = null;

if(isset($_GET['champion'])){
    $championId = $_GET['champion'];
$this_champion = ChampionsHelper::getDataById($connect, $championId, [ChampionConfig::ID->value, ChampionConfig::NAME->value]);

$relations = relationsHelper::getDataByChampionId($connect, $this_champion->getId());
}

$connect->close();