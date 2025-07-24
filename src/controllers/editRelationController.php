<?php

use UniverseLOL\Relation;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/relationsHelper.php";
require_once __DIR__ . "/../helpers/championsHelper.php";
require_once __DIR__ . "/../views/Templates/editRelationForm.php";

$config = new Config();
$connect = $config->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $action = $_POST['action'];
        $id = $_POST['id'];

        function getRelationDataFromPost(bool $includeId = false): array
        {
            $data = [
                RelationConfig::CHAMPION->value => $_POST['champion_id'] ?? null,
                RelationConfig::RELATED->value => $_POST['related_id'] ?? null,
                RelationConfig::RELATIONTYPE->value => $_POST['relation_type']  ?? null,
            ];

            if ($includeId) {
                $data[RelationConfig::ID->value] = $_POST['id'] ?? null;
            }

            return $data;
        }

        switch ($action) {
            case 'delete':
                $data = getRelationDataFromPost();
                if (RelationsHelper::deleteData($connect, $id)) {
                    header("Location: ../views/relations.php?champion={$data[RelationConfig::CHAMPION->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            case 'update':
                $data = getRelationDataFromPost();
                $checkId = RelationsHelper::checkExists($connect, $data[RelationConfig::CHAMPION->value], RelationConfig::CHAMPION->value, $data[RelationConfig::RELATED->value], RelationConfig::RELATED->value);
                if ($checkId) {
                    echo "<script>
                        alert(\"This ID '{$data[RelationConfig::RELATED->value]}' already exists. Please choose a different one!\");
                        history.back();
                    </script>";
                    exit();
                }
                if (RelationsHelper::updateData($connect, $data, $id)) {
                    header("Location: ../views/relations.php?champion={$data[RelationConfig::CHAMPION->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            case 'add':
                $data = getRelationDataFromPost();
                $checkId = RelationsHelper::checkExists($connect, $data[RelationConfig::CHAMPION->value], RelationConfig::CHAMPION->value, $data[RelationConfig::RELATED->value], RelationConfig::RELATED->value);
                if ($checkId) {
                    echo "<script>
                        alert(\"This ID '{$data[RelationConfig::RELATED->value]}' already exists. Please choose a different one!\");
                        history.back();
                    </script>";
                    exit();
                }

                if (RelationsHelper::addData($connect, $data)) {
                    header("Location: ../views/relations.php?champion={$data[RelationConfig::CHAMPION->value]}");
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
$relationId = $_GET['relation'] ?? null;

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
    $this_relation = new Relation();
} else {
    if (!$relationId || trim($relationId) === "") {
        header("Location: ../views/champions.php");
        exit();
    }
    $this_relation = RelationsHelper::getDataById($connect, $relationId);

    if ($this_relation === null || $this_relation->getChampion() !== $championId) {
        header("Location: ../views/champions.php");
        exit();
    }
}
$champions = ChampionsHelper::getData($connect, [ChampionConfig::ID->value, ChampionConfig::NAME->value]);

switch ($edit) {
    case 'add':
        $formEdit = editRelationForm($champions, $this_relation, "Add new relation : " . $this_champion->getName(), $championId, btnAdd(), true);
        break;
    case 'update';
        $formEdit = editRelationForm($champions, $this_relation, "Update relation : " . $this_champion->getName(), $championId, btnUpdate(), true);
        break;
    default:
        header("Location: ../views/champions.php");
        exit();
        break;
}


$connect->close();
