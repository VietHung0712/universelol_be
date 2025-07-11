<?php

use UniverseLOL\Skin;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/skinsHelper.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../views/Templates/editSkinForm.php";

$config = new Config();
$connect = $config->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'];

    function getSkinDataFromPost(bool $includeId = false): array
    {
        $data = [
            SkinConfig::NAME->value => $_POST['name'] ?? null,
            SkinConfig::CHAMPIONID->value => $_POST['champion_id'] ?? null,
            SkinConfig::SPLASHART->value => $_POST['splash_art']  ?? null,
        ];

        if ($includeId) {
            $data[SkinConfig::ID->value] = $_POST['id'] ?? null;
        }

        return $data;
    }


    switch ($action) {
        case 'delete':
            try {
                $data = getSkinDataFromPost();
                if (SkinsHelper::deleteData($connect, $id)) {
                    header("Location: ../views/skins.php?champion={$data[SkinConfig::CHAMPIONID->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
            break;
        case 'update':
            try {
                $data = getSkinDataFromPost();
                if (SkinsHelper::updateData($connect, $data, $id)) {
                    header("Location: ../views/skins.php?champion={$data[SkinConfig::CHAMPIONID->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        case 'add':
            try {
                $data = getSkinDataFromPost();
                if (SkinsHelper::addData($connect, $data)) {
                    header("Location: ../views/skins.php?champion={$data[SkinConfig::CHAMPIONID->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            };
            break;
        default:
            header("Location: ../views/champions.php");
            exit();
            break;
    }
}

$edit = null;
$formEdit = null;
$skinId = null;
$championId = null;
if (isset($_GET['skin'])) {
    $skinId = $_GET['skin'];
}
if (isset($_GET['edit'])) {
    $edit = $_GET['edit'];
}
if (isset($_GET['champion'])) {
    $championId = $_GET['champion'];
}

switch ($edit) {
    case 'add':
        $this_skin = new Skin();
        $this_champion = ChampionsHelper::getDataById($connect, $championId, [ChampionConfig::ID->value, ChampionConfig::NAME->value]);
        $formEdit = editSkinForm($this_skin, "Add new skin : " . $this_champion->getName(), $championId, btnAdd(), true);
        break;
    case 'update';
        $this_skin = SkinsHelper::getDataById($connect, $skinId);
        $championId = $this_skin->getChampionId();
        $this_champion = ChampionsHelper::getDataById($connect, $championId, [ChampionConfig::ID->value, ChampionConfig::NAME->value]);
        $formEdit = editSkinForm($this_skin, "Update skin : " . $this_champion->getName(), $championId, btnUpdate(), true);
        break;
    default:
        header("Location: ../views/champions.php");
        exit();
        break;
}


$connect->close();
