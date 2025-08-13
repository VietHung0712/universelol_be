<?php
require_once __DIR__ . '/../config/config.php';

$config = new Config();
$connect = $config->connect();

$variable = $_GET['variable'] ?? '';
$result = false;

switch ($variable) {
    case 'champions':
        require_once __DIR__ . '/../helpers/championsHelper.php';
        $filePath = '../json/champions.json';
        $champions = ChampionsHelper::getData($connect);
        $result = file_put_contents($filePath, json_encode($champions, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        break;

    case 'skins':
        require_once __DIR__ . '/../helpers/skinsHelper.php';
        $filePath = '../json/skins.json';
        $skins = SkinsHelper::getData($connect);
        $result = file_put_contents($filePath, json_encode($skins, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        break;

    case 'relations':
        require_once __DIR__ . '/../helpers/relationsHelper.php';
        $filePath = '../json/relations.json';
        $relations = RelationsHelper::getData($connect);
        $result = file_put_contents($filePath, json_encode($relations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        break;

    case 'regions':
        require_once __DIR__ . '/../helpers/regionsHelper.php';
        $filePath = '../json/regions.json';
        $regions = RegionsHelper::getData($connect);
        $result = file_put_contents($filePath, json_encode($regions, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        break;

    case 'roles':
        require_once __DIR__ . '/../helpers/rolesHelper.php';
        $filePath = '../json/roles.json';
        $roles = RolesHelper::getData($connect);
        $result = file_put_contents($filePath, json_encode($roles, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        break;
    case 'regionGallerys':
        require_once __DIR__ . '/../helpers/regionGallerysHelper.php';
        $filePath = '../json/regionGallerys.json';
        $maps = RegionGallerysHelper::getData($connect);
        $result = file_put_contents($filePath, json_encode($maps, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        break;
    default:
        header("Location: ../views/index.php");
        exit();
}

if ($result !== false) {
    echo "<script>alert('Data export successful!');
        window.location.href = '../views/admin.php';
    </script>";
    exit();
} else {
    echo "<script>alert('Export failed!');</script>";
}

$connect->close();
