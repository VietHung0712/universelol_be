<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../helpers/regionsHelper.php";
require_once __DIR__ . "/../helpers/rolesHelper.php";

$config = new Config();
$connect = $config->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $region = $_POST['region'];
    $role = $_POST['role'];
    $title = $_POST['title'];
    $voice = $_POST['voice'];
    $story = $_POST['story'];
    $splash_art = $_POST['splash_art'];
    $animated_splash_art = $_POST['animated_splash_art'];
    $positionX = $_POST['positionX'];
    $positionY = $_POST['positionY'];
    $model = $_POST['model'];
    $release_date = $_POST['release_date'];
    $updated_date = $_POST['updated_date'];

    $checkId = ChampionsHelper::checkExists($connect, $id);
    if($checkId) {
        echo "<script>
                alert('This ID \"$id\" already exists. Please choose a different one!');
                history.back();
              </script>";
        exit();
    }

    try {
        $data = [
            ChampionConfig::ID->value => $id,
            ChampionConfig::NAME->value => $name,
            ChampionConfig::REGION->value => $region,
            ChampionConfig::ROLE->value => $role,
            ChampionConfig::TITLE->value => $title,
            ChampionConfig::VOICE->value => $voice,
            ChampionConfig::STORY->value => $story,
            ChampionConfig::SPLASHART->value => $splash_art,
            ChampionConfig::ANIMATEDSPLASHART->value => $animated_splash_art,
            ChampionConfig::POSITIONX->value => $positionX,
            ChampionConfig::POSITIONY->value => $positionY,
            ChampionConfig::MODEL->value => $model,
            ChampionConfig::RELEASEDATE->value => $release_date,
            ChampionConfig::UPDATEDDATE->value => $updated_date,
        ];

        if (ChampionsHelper::addData($connect, $data)) {
            header("Location: ../views/champions.php");
            exit();
        } else {
            echo "<script>console.log('Error while executing!')</script>";
        }
    } catch (\Throwable $th) {
        echo $th->getMessage();
    };
}

$colsRegion = [
    RegionConfig::ID->value,
    RegionConfig::NAME->value
];
$colsRole = [
    RoleConfig::ID->value,
    RoleConfig::NAME->value
];

$regions = RegionsHelper::getData($connect, $colsRegion);
$roles = RolesHelper::getData($connect, $colsRole);
$connect->close();
