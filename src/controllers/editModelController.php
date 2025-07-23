<?php

use UniverseLOL\Model;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/modelsHelper.php";
require_once __DIR__ . "/../helpers/skinsHelper.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../views/Templates/editModelForm.php";

$config = new Config();
$connect = $config->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $action = $_POST['action'];
        $id = $_POST['id'];

        function getModelDataFromPost(bool $includeId = false): array
        {

            if ($_POST['skin_id'] !== '0') $skinId = $_POST['skin_id'] ?? NULL;
            $data = [
                ModelConfig::CHAMPIONID->value => $_POST['champion_id'] ?? null,
                ModelConfig::SKINID->value => $skinId ?? null,
                ModelConfig::MODEL->value => $_POST['model']  ?? null,
                ModelConfig::POSTER->value => $_POST['poster']  ?? null,
            ];

            if ($includeId) {
                $data[ModelConfig::ID->value] = $_POST['id'] ?? null;
            }

            return $data;
        }

        switch ($action) {
            case 'delete':
                $data = getModelDataFromPost();
                if (ModelsHelper::deleteData($connect, $id)) {
                    header("Location: ../views/models.php?champion={$data[ModelConfig::CHAMPIONID->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            case 'update':
                $data = getModelDataFromPost();
                if (ModelsHelper::updateData($connect, $data, $id)) {
                    header("Location: ../views/models.php?champion={$data[ModelConfig::CHAMPIONID->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            case 'add':
                $data = getModelDataFromPost();
                if (ModelsHelper::addData($connect, $data)) {
                    header("Location: ../views/models.php?champion={$data[ModelConfig::CHAMPIONID->value]}");
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
$modelId = $_GET['model'] ?? null;

if (!$championId || trim($championId) === "") {
    header("Location: ../views/champions.php");
    exit();
}
$this_champion = ChampionsHelper::getDataById($connect, $championId, [ChampionConfig::ID->value, ChampionConfig::NAME->value]);
$skins = SkinsHelper::getDataByChampionId($connect, $championId, [SkinConfig::ID->value, SkinConfig::NAME->value]);

if ($this_champion === null) {
    header("Location: ../views/champions.php");
    exit();
}

if ($edit === "add") {
    $this_model = new Model();
} else {
    if (!$modelId || trim($modelId) === "") {
        header("Location: ../views/champions.php");
        exit();
    }

    $this_model = ModelsHelper::getDataById($connect, $modelId);

    if ($this_model === null || $this_model->getChampionId() !== $championId) {
        header("Location: ../views/champions.php");
        exit();
    }
}

switch ($edit) {
    case 'add':
        $formEdit = editModelForm($this_model, $skins, "Add new model : " . $this_champion->getName(), $championId, btnAdd(), true);
        break;
    case 'update';
        $formEdit = editModelForm($this_model, $skins, "Update model : " . $this_champion->getName(), $championId, btnUpdate(), true);
        break;
    default:
        header("Location: ../views/champions.php");
        exit();
        break;
}


$connect->close();
