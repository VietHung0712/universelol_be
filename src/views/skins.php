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
        <!-- <form action="">
            <table class="submit">
                <tr>
                    <td>
                        <input type="text" name="name" placeholder="Name..." required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="inputSplashArt" type="url" name="url" placeholder="Url..." required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img class="imgSplashArt" height="200" width="300" src="" alt="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit">Add</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="reset">Reset</button>
                    </td>
                </tr>
            </table>
        </form> -->
        <table id="list" class="submit table__tr">
            <caption><?php echo $this_champion->getName(); ?>:<?php echo count($skins); ?></caption>
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Splash Art</th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <?php
                foreach ($skins as $key => $value) {
                ?>
                    <tr>
                        <td>
                            <input type="number" value="<?php echo $value->getId(); ?>" disabled>
                            <input type="hidden" name="id" value="<?php echo $value->getId(); ?>">
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $value->getName(); ?>" placeholder="Name..." required readonly>
                        </td>
                        <td>
                            <input type="url" name="splash_art" class="inputSplashArt" value="<?php echo $value->getSplashArt(); ?>" placeholder="Url..." required readonly>
                        </td>
                        <td>
                            <img class="imgSplashArt" height="200" width="300" src="<?php echo $value->getSplashArt(); ?>" alt="">
                        </td>
                        <td>
                            <button class="btnOpenUpdate" type="button">Update</button>
                        </td>
                        <td>
                            <button class="btnDel" type="button">Delete</button>
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

<script type="module">
    import {
        $,
        $$,
        getSrcFromInput,
        confirmSubmit
    } from "../js/functions.js";

    const $$inputSplashArt = $$('.inputSplashArt');
    const $$imgSplashArt = $$('.imgSplashArt');
    const $$btnOpenUpdate = $$('.btnOpenUpdate');
    const $$btnDel = $$('.btnDel');

    let checkUp = false;

    // $$btnOpenUpdate.forEach((e, i) => {
    //     e.addEventListener('click', () => {

    //     })
    // });

    // $btnOpenUpdate.addEventListener('click', () => {
    //     if (!checkUp) {
    //         $$('input').forEach(el => el.readOnly = false);
    //         $$('.tdAction').forEach(el => {
    //             el.style.visibility = 'visible';
    //         });
    //         $btnOpenUpdate.textContent = 'Cancel';
    //     } else {
    //         $('form#submit').reset();
    //         $$('input').forEach(el => el.readOnly = true);
    //         $$('.tdAction').forEach(el => {
    //             el.style.visibility = 'hidden';
    //         });
    //         $btnOpenUpdate.textContent = 'Update';
    //     }
    //     checkUp = !checkUp;
    // });

    // $$inputSplashArt.forEach((el, i) => {
    //     el.addEventListener('input', () => {
    //         getSrcFromInput($$imgSplashArt[i], el);
    //     });
    // });

    // confirmSubmit($('form#submit'), $('#btnUpdate'), "Confirm update?");
    // confirmSubmit($('form#submit'), $('#btnDel'), "Confirm delete?");
</script>