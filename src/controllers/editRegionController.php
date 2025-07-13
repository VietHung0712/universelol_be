<?php

use UniverseLOL\Region;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/regionsHelper.php";
require_once __DIR__ . "/../views/Templates/editRegionForm.php";

$config = new Config();
$connect = $config->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
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
                $data = getRegionDataFromPost();
                if (RegionsHelper::deleteData($connect, $id)) {
                    header("Location: ../views/regions.php");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            case 'update':
                $data = getRegionDataFromPost();
                if (RegionsHelper::updateData($connect, $data, $id)) {
                    header("Location: ../views/editRegion.php?edit=details&region=$id");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
            case 'add':
                $checkId = RegionsHelper::checkExists($connect, $id);
                if ($checkId) {
                    echo "<script>
                        alert('This ID \"$id\" already exists. Please choose a different one!');
                        history.back();
                    </script>";
                    exit();
                }
                $data = getRegionDataFromPost(true);
                if (RegionsHelper::addData($connect, $data)) {
                    header("Location: ../views/editRegion.php?edit=details&region=$id");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            default:
                header("Location: ../views/regions.php");
                exit();
                break;
        }
    } catch (\Throwable $th) {
        header("Location: ../views/regions.php");
        exit();
    }
}

$edit = $_GET['edit'] ?? null;
$regionId = $_GET['region'] ?? null;

if ($edit === "add") {
    $this_region = new Region();
} else {
    if (!$regionId || trim($regionId) === "") {
        header("Location: ../views/regions.php");
        exit();
    }
    $this_region = RegionsHelper::getDataById($connect, $regionId);
    if ($this_region === null) {
        header("Location: ../views/regions.php");
        exit();
    }
}

switch ($edit) {
    case 'add':
        $formEdit = editRegionForm($this_region, "Add new region", btnReset(), btnAdd(), false);
        break;
    case 'update';
        $formEdit = editRegionForm($this_region, "Update region : " . $regionId, btnReset(), btnUpdate());
        break;
    case 'details';
        $formEdit = editRegionForm($this_region, "Details : " . $regionId, btnDelete(), null);
        break;
    default:
        header("Location: ../views/regions.php");
        exit();
        break;
}


$connect->close();
