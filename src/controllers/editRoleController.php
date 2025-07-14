<?php

use UniverseLOL\Role;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../helpers/rolesHelper.php";
require_once __DIR__ . "/../views/Templates/editRoleForm.php";

$config = new Config();
$connect = $config->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $action = $_POST['action'];
        $id = $_POST['id'];

        function getRoleDataFromPost(bool $includeId = false): array
        {
            $data = [
                RoleConfig::NAME->value => $_POST['name'] ?? null,
                RoleConfig::ICON->value => $_POST['icon']  ?? null
            ];

            if ($includeId) {
                $data[RoleConfig::ID->value] = $_POST['id'] ?? null;
            }

            return $data;
        }

        switch ($action) {
            case 'delete':
                $data = getRoleDataFromPost();
                if (RolesHelper::deleteData($connect, $id)) {
                    header("Location: ../views/roles.php");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            case 'update':
                $data = getRoleDataFromPost();
                if (RolesHelper::updateData($connect, $data, $id)) {
                    header("Location: ../views/editRole.php?edit=details&role=$id");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
            case 'add':
                $checkId = RolesHelper::checkExists($connect, $id);
                if ($checkId) {
                    echo "<script>
                        alert('This ID \"$id\" already exists. Please choose a different one!');
                        history.back();
                    </script>";
                    exit();
                }
                $data = getRoleDataFromPost(true);
                if (RolesHelper::addData($connect, $data)) {
                    header("Location: ../views/editRole.php?edit=details&role=$id");
                    exit();
                } else {
                    echo "<script>console.log('Error while executing!')</script>";
                }
                break;
            default:
                header("Location: ../views/roles.php");
                exit();
                break;
        }
    } catch (\Throwable $th) {
        header("Location: ../views/roles.php");
        exit();
    }
}

$edit = $_GET['edit'] ?? null;
$roleId = $_GET['role'] ?? null;

if ($edit === "add") {
    $this_role = new Role();
} else {
    if (!$roleId || trim($roleId) === "") {
        header("Location: ../views/roles.php");
        exit();
    }
    $this_role = RolesHelper::getDataById($connect, $roleId);
    if ($this_role === null) {
        header("Location: ../views/roles.php");
        exit();
    }
}

switch ($edit) {
    case 'add':
        $formEdit = editRoleForm($this_role, "Add new role", btnReset(), btnAdd(), false);
        break;
    case 'update';
        $formEdit = editRoleForm($this_role, "Update role : " . $roleId, btnReset(), btnUpdate());
        break;
    case 'details';
        $formEdit = editRoleForm($this_role, "Details : " . $roleId, btnDelete(), null);
        break;
    default:
        header("Location: ../views/roles.php");
        exit();
        break;
}


$connect->close();
