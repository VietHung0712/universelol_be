<?php

use UniverseLOL\RegionGallery;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/regionGallerysHelper.php";
require_once __DIR__ . "/../helpers/regionsHelper.php";
require_once __DIR__ . "/../views/Templates/editRegionGalleryForm.php";

$config = new Config();
$connect = $config->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $action = $_POST['action'];
        $id = $_POST['id'];

        function getGalleryDataFromPost(bool $includeId = false): array
        {
            $data = [
                RegionGalleryConfig::REGION->value => $_POST['region_id'] ?? null,
                RegionGalleryConfig::GALLERY->value => $_POST['gallery']  ?? null,
            ];

            if ($includeId) {
                $data[RegionGalleryConfig::ID->value] = $_POST['id'] ?? null;
            }

            return $data;
        }

        switch ($action) {
            case 'delete':
                $data = getGalleryDataFromPost();
                if (RegionGallerysHelper::deleteData($connect, $id)) {
                    header("Location: ../views/regionGallerys.php?region={$data[RegionGalleryConfig::REGION->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            case 'update':
                $data = getGalleryDataFromPost();
                if (RegionGallerysHelper::updateData($connect, $data, $id)) {
                    header("Location: ../views/regionGallerys.php?region={$data[RegionGalleryConfig::REGION->value]}");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            case 'add':
                $data = getGalleryDataFromPost();
                if (RegionGallerysHelper::addData($connect, $data)) {
                    header("Location: ../views/regionGallerys.php?region={$data[RegionGalleryConfig::REGION->value]}");
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
$regionGalleryId = $_GET['regionGallery'] ?? null;

if (!$regionId || trim($regionId) === "") {
    header("Location: ../views/regions.php");
    exit();
}
$this_region = regionsHelper::getDataById($connect, $regionId, [regionConfig::ID->value, regionConfig::NAME->value]);
if ($this_region === null) {
    header("Location: ../views/regions.php");
    exit();
}

if ($edit === "add") {
    $this_regionGallery = new RegionGallery();
} else {
    if (!$regionGalleryId || trim($regionGalleryId) === "") {
        header("Location: ../views/regions.php");
        exit();
    }
    $this_regionGallery = RegionGallerysHelper::getDataById($connect, $regionGalleryId);

    if ($this_regionGallery === null || $this_regionGallery->getRegion() !== $regionId) {
        header("Location: ../views/regions.php");
        exit();
    }
}

switch ($edit) {
    case 'add':
        $formEdit = editRegionGalleryForm($this_regionGallery, "Add new gallery : " . $this_region->getName(), $regionId, btnAdd(), true);
        break;
    case 'update';
        $formEdit = editRegionGalleryForm($this_regionGallery, "Update gallery : " . $this_region->getName(), $regionId, btnUpdate(), true);
        break;
    default:
        header("Location: ../views/regions.php");
        exit();
        break;
}


$connect->close();
