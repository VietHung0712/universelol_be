<?php

use UniverseLOL\Champion;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../helpers/regionsHelper.php";
require_once __DIR__ . "/../helpers/rolesHelper.php";
require_once __DIR__ . "/../views/Templates/editChampionForm.php";

$config = new Config();
$connect = $config->connect();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'];

    function getChampionDataFromPost(bool $includeId = false): array
    {
        $data = [
            ChampionConfig::NAME->value => $_POST['name'],
            ChampionConfig::REGION->value => $_POST['region'],
            ChampionConfig::ROLE->value => $_POST['role'],
            ChampionConfig::TITLE->value => $_POST['title'],
            ChampionConfig::VOICE->value => $_POST['voice'],
            ChampionConfig::STORY->value => $_POST['story'],
            ChampionConfig::SPLASHART->value => $_POST['splash_art'],
            ChampionConfig::ANIMATEDSPLASHART->value => $_POST['animated_splash_art'],
            ChampionConfig::POSITIONX->value => $_POST['positionX'],
            ChampionConfig::POSITIONY->value => $_POST['positionY'],
            ChampionConfig::MODEL->value => $_POST['model'],
            ChampionConfig::RELEASEDATE->value => $_POST['release_date'],
            ChampionConfig::UPDATEDDATE->value => $_POST['updated_date'],
        ];

        if ($includeId) {
            $data[ChampionConfig::ID->value] = $_POST['id'];
        }

        return $data;
    }


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
            try {
                $data = getChampionDataFromPost();
                if (ChampionsHelper::updateData($connect, $data, $id)) {
                    header("Location: ../views/champion.php?champion=$id");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        case 'add':
            $checkId = ChampionsHelper::checkExists($connect, $id);
            if ($checkId) {
                echo "<script>
                alert('This ID \"$id\" already exists. Please choose a different one!');
                history.back();
              </script>";
                exit();
            }

            try {
                $data = getChampionDataFromPost(true);
                if (ChampionsHelper::addData($connect, $data)) {
                    header("Location: ../views/champions.php");
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

$edit = $_GET['edit'];
$formEdit = "";
$championId = null;

switch ($edit) {
    case 'add':
        $this_champion = new Champion();
        $formEdit = editchampionForm($regions, $roles, $this_champion, "Add new champion", btnReset(), btnAdd());
        break;
    case 'update';
        $championId = $_GET['champion'];
        $this_champion = ChampionsHelper::getDataById($connect, $championId);
        $formEdit = editchampionForm($regions, $roles, $this_champion, "Details : " . $this_champion->getName(), btnReset(), btnUpdate());
        break;
    case 'details';
        $championId = $_GET['champion'];
        $this_champion = ChampionsHelper::getDataById($connect, $championId);
        $formEdit = editchampionForm($regions, $roles, $this_champion, "Details : " . $this_champion->getName(), btnChange($championId), btnDelete());
        break;
    default:
        # code...
        break;
}


$connect->close();
