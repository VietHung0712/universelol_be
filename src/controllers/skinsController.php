<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../helpers/skinsHelper.php";

$config = new Config();
$connect = $config->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'];

    switch ($action) {
        case 'delete':
            if (ChampionsHelper::deleteData($connect, $id)) {
                header("Location: ../views/champions.php");
                exit();
            } else {
                echo "<script>console.log('Error while executing!')</script>";
            }
            break;
        case 'update':
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

            try {
                $data = [
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

                if (ChampionsHelper::updateData($connect, $data, $id)) {
                    header("Location: ../views/champion.php?champion=$id");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            };

            break;
        default:
            # code...
            break;
    }
}

$championId = $_GET['champion'];
$this_champion = ChampionsHelper::getDataById($connect, $championId);

$skinCols = [
    SkinConfig::ID->value,
    SkinConfig::NAME->value,
    SkinConfig::SPLASHART->value
];

$skins = SkinsHelper::getDataByChampionId($connect, $this_champion->getId(), $skinCols);

$connect->close();
