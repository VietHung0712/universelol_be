<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <title>Admin</title>
</head>
<body>
    <?php require_once __DIR__ . "/Templates/header.php"; ?>
    <main>
        <ul class="display">
            <li>
                <a href="../core/export.php?variable=champions">Export Champions</a>
            </li>
            <li>
                <a href="../core/export.php?variable=skins">Export Skins</a>
            </li>
            <li>
                <a href="../core/export.php?variable=relations">Export Relations</a>
            </li>
            <li>
                <a href="../core/export.php?variable=regions">Export Regions</a>
            </li>
            <li>
                <a href="../core/export.php?variable=roles">Export Roles</a>
            </li>
            <li>
                <a href="./editAdmin.php">Change Password Admin</a>
            </li>
        </ul>
    </main>
    <?php require_once __DIR__ . "/Templates/footer.php"; ?>
</body>
<style>
    ul.display {
        height: 100%;   

        li {
            margin-top: 5vh;
            background: #000;
            padding: 10px;
            text-align: center;

            a {
                display: block;
                text-decoration: none;
                font-weight: bold;
                width: 100%;
                height: 100%;
                transition: all 300ms ease-in-out;
                color: #fff;

                &:hover {
                    color: aqua;
                    transform: scale(1.1);
                }
            }
        }
    }
</style>
</html>