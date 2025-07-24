<?php

use UniverseLOL\Skin;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/skinsHelper.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../views/Templates/editSkinForm.php";

$config = new Config();
$connect = $config->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $action = $_POST['action'];
        $id = $_POST['id'];

        function getSkinDataFromPost(bool $includeId = false): array
        {
            $data = [
                SkinConfig::NAME->value => $_POST['name'] ?? null,
                SkinConfig::CHAMPION->value => $_POST['champion_id'] ?? null,
                SkinConfig::SPLASHART->value => $_POST['splash_art']  ?? null,
            ];

            if ($includeId) {
                $data[SkinConfig::ID->value] = $_POST['id'] ?? null;
            }

            return $data;
        }

        switch ($action) {
            case 'delete':
                $data = getSkinDataFromPost();
                if (SkinsHelper::deleteData($connect, $id)) {
                    header("Location: ../views/skins.php?champion={$data[SkinConfig::CHAMPION->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            case 'update':
                $data = getSkinDataFromPost();
                if (SkinsHelper::updateData($connect, $data, $id)) {
                    header("Location: ../views/skins.php?champion={$data[SkinConfig::CHAMPION->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            case 'add':
                $data = getSkinDataFromPost();
                if (SkinsHelper::addData($connect, $data)) {
                    header("Location: ../views/skins.php?champion={$data[SkinConfig::CHAMPION->value]}");
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
$skinId = $_GET['skin'] ?? null;

if (!$championId || trim($championId) === "") {
    header("Location: ../views/champions.php");
    exit();
}
$this_champion = ChampionsHelper::getDataById($connect, $championId, [ChampionConfig::ID->value, ChampionConfig::NAME->value]);
if ($this_champion === null) {
    header("Location: ../views/champions.php");
    exit();
}

if ($edit === "add") {
    $this_skin = new Skin();
} else {
    if (!$skinId || trim($skinId) === "") {
        header("Location: ../views/champions.php");
        exit();
    }
    $this_skin = SkinsHelper::getDataById($connect, $skinId);

    if ($this_skin === null || $this_skin->getChampion() !== $championId) {
        header("Location: ../views/champions.php");
        exit();
    }
}

switch ($edit) {
    case 'add':
        $formEdit = editSkinForm($this_skin, "Add new skin : " . $this_champion->getName(), $championId, btnAdd(), true);
        break;
    case 'update';
        $formEdit = editSkinForm($this_skin, "Update skin : " . $this_champion->getName(), $championId, btnUpdate(), true);
        break;
    default:
        header("Location: ../views/champions.php");
        exit();
        break;
}


$connect->close();
