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
    try {
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
                $data = getChampionDataFromPost();
                if (ChampionsHelper::updateData($connect, $data, $id)) {
                    header("Location: ../views/editChampion.php?edit=details&champion=$id");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
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

                $data = getChampionDataFromPost(true);
                if (ChampionsHelper::addData($connect, $data)) {
                    header("Location: ../views/editChampion.php?edit=details&champion=$id");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            default:
                header("Location: ../views/champions.php");
                exit();
                break;
        }
    } catch (\Throwable $th) {
        header("Location: ../views/champions.php");
        exit();
    }
}

$edit = $_GET['edit'] ?? null;
$championId = $_GET['champion'] ?? null;

if ($edit === "add") {
    $this_champion = new Champion();
} else {
    if (!$championId || trim($championId) === "") {
        header("Location: ../views/champions.php");
        exit();
    }
    $this_champion = ChampionsHelper::getDataById($connect, $championId);
    if ($this_champion === null) {
        header("Location: ../views/champions.php");
        exit();
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

switch ($edit) {
    case 'add':
        $formEdit = editChampionForm($regions, $roles, $this_champion, "Add new champion", btnReset(), btnAdd(), false);
        break;
    case 'update';
        $formEdit = editChampionForm($regions, $roles, $this_champion, "Update : " . $this_champion->getId(), btnReset(), btnUpdate());
        break;
    case 'details';
        $formEdit = editChampionForm($regions, $roles, $this_champion, "Details : " . $this_champion->getId(), btnDelete(), null);
        break;
    default:
        header("Location: ../views/champions.php");
        exit();
        break;
}
$connect->close();
