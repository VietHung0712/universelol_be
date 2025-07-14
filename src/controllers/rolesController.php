<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/rolesHelper.php";

try {
    $config = new Config();
    $connect = $config->connect();
    $cols = [
        RoleConfig::ID->value,
        RoleConfig::NAME->value
    ];
    $roles = RolesHelper::getData($connect, $cols);

    $connect->close();
} catch (\Throwable $th) {
    header("Location: ../views/index.php");
    exit();
}
