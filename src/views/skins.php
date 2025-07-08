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
        <form id="submit" action="../controllers/championController.php" method="POST">
            <table id="submit" class="table__tr">
                <caption><?php echo $this_champion->getName(); ?></caption>
                <?php
                foreach ($skins as $key => $value) {
                ?>
                    <tr>
                        <th><?php echo $key; ?></th>
                        <td>
                            <form action="">
                                <input type="number" value="<?php echo $value->getId(); ?>" disabled>
                                <input type="hidden" name="id" value="<?php echo $value->getId(); ?>">
                                <input type="text" name="name" value="<?php echo $value->getName(); ?>" placeholder="Name..." required readonly>
                                <input type="url" name="splash_art" class="inputSplashArt" value="<?php echo $value->getSplashArt(); ?>" placeholder="Url..." required readonly>
                            </form>
                        </td>
                        <td>
                            <img class="imgSplashArt" height="200" width="300" src="<?php echo $value->getSplashArt(); ?>" alt="">
                        </td>
                        <td>
                            <button class="btnDel" type="submit" name="action" value="delete">Delete</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <th><button id="btnOpenUpdate" type="button">Update</button></th>
                    <td id="tdAction" style="visibility: hidden;">
                        <button id="btnUpdate" type="submit" name="action" value="update">Save</button>
                        <button type="reset">Reset</button>
                    </td>
                </tr>
            </table>
        </form>
    </main>
</body>

</html>

<script type="module">
    import {
        $,
        $$,
        getSrcFromInput,
        confirmSubmit
    } from "../js/functions.js";

    const $$inputSplashArt = $$('.inputSplashArt');
    const $$imgSplashArt = $$('.imgSplashArt');
    const $btnOpenUpdate = $('#btnOpenUpdate');
    const $$btnDel = $$('.btnDel');

    let checkUp = false;

    $btnOpenUpdate.addEventListener('click', () => {
        if (!checkUp) {
            $$('input').forEach(el => el.readOnly = false);
            $('#tdAction').style.visibility = 'visible';
            $btnOpenUpdate.textContent = 'Cancel';
        } else {
            $('form#submit').reset();
            $$('input').forEach(el => el.readOnly = true);
            $('#tdAction').style.visibility = 'hidden';
            $btnOpenUpdate.textContent = 'Update';
        }
        checkUp = !checkUp;
    });

    $$inputSplashArt.forEach((el, i) => {
        el.addEventListener('input', () => {
            getSrcFromInput($$imgSplashArt[i], el);
        });
    });

    // confirmSubmit($('form#submit'), $('#btnUpdate'), "Confirm update?");
    // confirmSubmit($('form#submit'), $('#btnDel'), "Confirm delete?");
</script>