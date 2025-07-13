<!DOCTYPE html>
<html lang="en">
<?php
try {
    require_once "../controllers/rolesController.php";
} catch (\Throwable $th) {
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <title>Roles - Admin</title>
</head>

<body>
    <main>
        <?php require_once __DIR__ . "/Templates/header.php"; ?>
        <div id="addNew">
            <a href="./editRole.php?edit=add">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                </svg>
            </a>
        </div>
        <table id="list" class="table__tr">
            <caption>Roles</caption>
            <thead id="thead__pc">
                <th>ID</th>
                <th>Name</th>
                <th>Details</th>
            </thead>

            <tbody>
                <?php
                if (isset($roles)) {
                    foreach ($roles as $i => $item) {
                ?>
                        <tr>
                            <th class="thead__mobile">ID</th>
                            <td>
                                <input type="text" value="<?php echo $item->getId(); ?>" disabled>
                            </td>
                            <th class="thead__mobile">Name</th>
                            <td>
                                <input type="text" value="<?php echo $item->getName(); ?>" disabled>
                            </td>
                            <th class="thead__mobile">Details</th>
                            <td>
                                <a href="./editRole.php?edit=details&role=<?php echo $item->getId(); ?>">
                                    <span>View</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>

        </table>
    </main>
</body>

</html>