<!DOCTYPE html>
<html lang="en">
<?php
try {
    require_once "../controllers/skinsController.php";
} catch (\Throwable $th) {
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <title><?php echo $this_champion->getName(); ?> - Admin</title>
</head>

<body>
    <?php require_once __DIR__ . "/Templates/header.php"; ?>
    <main>
        <div id="tools">
            <ul>
                <li>
                    <a style="text-decoration: none;" href="./champion.php?champion=<?php echo $this_champion->getId(); ?>">
                        <?php echo $this_champion->getName(); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="./skins.php?champion=<?php echo $this_champion->getId(); ?>">Skins</a>
                </li>
                <li>
                    <a href="">Relations</a>
                </li>
            </ul>
        </div>
        <div id="addNew">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                </svg>
            </button>
        </div>

        <table id="" class="submit table__tr">
            <caption><?php echo $this_champion->getName(); ?>:<?php echo count($skins); ?></caption>
            <thead id="thead__pc">
                <th>Id</th>
                <th>Name</th>
                <th>Splash Art</th>
                <th></th>
                <th>Details</th>
            </thead>
            <tbody>
                <?php
                foreach ($skins as $key => $value) {
                ?>
                    <tr>
                        <th class="thead__mobile">Id</th>
                        <td>
                            <input type="number" value="<?php echo $value->getId(); ?>" disabled readonly>
                            <input type="hidden" name="id" value="<?php echo $value->getId(); ?>" readonly>
                        </td>
                        <th class="thead__mobile">Name</th>
                        <td>
                            <input type="text" name="name" value="<?php echo $value->getName(); ?>" placeholder="Name..." required readonly>
                        </td>
                        <th class="thead__mobile">Splash Art</th>
                        <td>
                            <input type="url" name="splash_art" class="inputSplashArt" value="<?php echo $value->getSplashArt(); ?>" placeholder="Url..." required readonly>
                        </td>
                        <td>
                            <img class="imgSplashArt" height="200" width="300" src="<?php echo $value->getSplashArt(); ?>" alt="">
                        </td>
                        <td>
                            <a href="">View</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>