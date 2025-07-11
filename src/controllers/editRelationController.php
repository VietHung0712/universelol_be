<?php

use UniverseLOL\Relation;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/relationsHelper.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../views/Templates/editRelationForm.php";

$config = new Config();
$connect = $config->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'];

    function getRelationDataFromPost(bool $includeId = false): array
    {
        $data = [
            RelationConfig::CHAMPIONID->value => $_POST['champion_id'] ?? null,
            RelationConfig::RELATEDID->value => $_POST['related_id'] ?? null,
            RelationConfig::RELATIONTYPE->value => $_POST['relation_type']  ?? null,
        ];

        if ($includeId) {
            $data[RelationConfig::ID->value] = $_POST['id'] ?? null;
        }

        return $data;
    }


    switch ($action) {
        case 'delete':
            try {
                $data = getRelationDataFromPost();
                if (RelationsHelper::deleteData($connect, $id)) {
                    header("Location: ../views/relations.php?champion={$data[RelationConfig::CHAMPIONID->value]}");
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
                $data = getRelationDataFromPost();
                $checkId = RelationsHelper::checkExists($connect, $data[RelationConfig::CHAMPIONID->value], RelationConfig::CHAMPIONID->value, $data[RelationConfig::RELATEDID->value], RelationConfig::RELATEDID->value);
                if ($checkId) {
                    echo "<script>
                        alert(\"This ID '{$data[RelationConfig::RELATEDID->value]}' already exists. Please choose a different one!\");
                        history.back();
                    </script>";
                    exit();
                }
                if (RelationsHelper::updateData($connect, $data, $id)) {
                    header("Location: ../views/relations.php?champion={$data[RelationConfig::CHAMPIONID->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
            break;
        case 'add':
            try {
                $data = getRelationDataFromPost();
                $checkId = RelationsHelper::checkExists($connect, $data[RelationConfig::CHAMPIONID->value], RelationConfig::CHAMPIONID->value, $data[RelationConfig::RELATEDID->value], RelationConfig::RELATEDID->value);
                if ($checkId) {
                    echo "<script>
                        alert(\"This ID '{$data[RelationConfig::RELATEDID->value]}' already exists. Please choose a different one!\");
                        history.back();
                    </script>";
                    exit();
                }

                if (RelationsHelper::addData($connect, $data)) {
                    header("Location: ../views/relations.php?champion={$data[RelationConfig::CHAMPIONID->value]}");
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
$relationId = null;
$championId = null;
if (isset($_GET['relation'])) {
    $relationId = $_GET['relation'];
}
if (isset($_GET['edit'])) {
    $edit = $_GET['edit'];
}
if (isset($_GET['champion'])) {
    $championId = $_GET['champion'];
}

$colsChampion = [ChampionConfig::ID->value, ChampionConfig::NAME->value];

$champions = ChampionsHelper::getData($connect, $colsChampion);

switch ($edit) {
    case 'add':
        $this_relation = new Relation();
        $this_champion = ChampionsHelper::getDataById($connect, $championId, $colsChampion);
        $formEdit = editRelationForm($champions, $this_relation, "Add new skin : " . $this_champion->getName(), $championId, btnAdd(), true);
        break;
    case 'update';
        $this_relation = RelationsHelper::getDataById($connect, $relationId);
        $championId = $this_relation->getChampionId();
        $this_champion = ChampionsHelper::getDataById($connect, $championId, $colsChampion);
        $formEdit = editRelationForm($champions, $this_relation, "Update relation : " . $this_champion->getName(), $championId, btnUpdate(), true);
        break;
    default:
        header("Location: ../views/champions.php");
        exit();
        break;
}


$connect->close();
