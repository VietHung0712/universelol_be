<?php

use UniverseLOL\Region;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/regionsHelper.php";
require_once __DIR__ . "/../views/Templates/editRegionForm.php";

$config = new Config();
$connect = $config->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'];

    function getRegionDataFromPost(bool $includeId = false): array
    {
        $data = [
            RegionConfig::NAME->value => $_POST['name'] ?? null,
            RegionConfig::TITLE->value => $_POST['title'] ?? null,
            RegionConfig::STORY->value => $_POST['story'] ?? null,
            RegionConfig::ICON->value => $_POST['icon']  ?? null,
            RegionConfig::AVATAR->value => $_POST['avatar']  ?? null,
            RegionConfig::BACKGROUND->value => $_POST['background']  ?? null,
            RegionConfig::ANIMATEDBACKGROUND->value => $_POST['animated_background']  ?? null
        ];

        if ($includeId) {
            $data[RegionConfig::ID->value] = $_POST['id'] ?? null;
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
                    header("Location: ../views/skins.php?champion=$id}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        case 'add':
            try {
                $data = getRegionDataFromPost();
                if (RegionsHelper::addData($connect, $data)) {
                    header("Location: ../views/regions.php?region=$id");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
            };
            break;
        default:
            header("Location: ../views/regions.php");
            exit();
            break;
    }
}

$edit = null;
$formEdit = null;
$regionId = null;
if (isset($_GET['region'])) {
    $regionId = $_GET['region'];
}
if (isset($_GET['edit'])) {
    $edit = $_GET['edit'];
}

switch ($edit) {
    case 'add':
        $this_region = new Region();
        $formEdit = editRegionForm($this_region, "Add new region", btnReset(), btnAdd(), false);
        break;
    case 'update';
        $this_region = RegionsHelper::getDataById($connect, $regionId);
        $formEdit = editRegionForm($this_region, "Update region : " . $regionId, btnReset(), btnUpdate());
        break;
    case 'details';
        $this_region = regionsHelper::getDataById($connect, $regionId);
        $formEdit = editRegionForm($this_region, "Details : " . $regionId, btnDelete(), null);
        break;
    default:
        header("Location: ../views/regions.php");
        exit();
        break;
}


$connect->close();
