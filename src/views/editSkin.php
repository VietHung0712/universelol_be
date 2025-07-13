<!DOCTYPE html>
<html lang="en">
<?php
try {
    require_once __DIR__ . "/../controllers/editSkinController.php";
} catch (\Throwable $th) {
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <title>Edit Skin</title>
</head>

<body>
    <?php require_once __DIR__ . "/Templates/header.php"; ?>
    <main>
        <div id="tools">
            <ul>
                <li><a href="./champions.php">Champions</a></li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>
                </li>
                <li>
                    <a
                        href="./editChampion.php?edit=details&champion=<?php echo $championId; ?>">
                        <span><?php echo $this_champion->getName(); ?></span>
                    </a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>
                </li>
                <li>
                    <a href="./skins.php?champion=<?php echo $championId; ?>">Skins</a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>
                </li>
                <?php
                if ($edit === 'add' && !empty($championId)) {
                ?>
                    <li>
                        <a href="./editSkin.php?edit=add&champion=<?php echo $championId; ?>">Add</a>
                    </li>
                <?php
                } else if ($edit === 'update' && !empty($championId) && !empty($skinId)) {
                ?>
                    <li>
                        <a href="./editSkin.php?edit=update&champion=<?php echo $championId; ?>&skin=<?php echo $skinId; ?>">Update</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <?php
        if (isset($formEdit) && !empty($formEdit)) {
            echo $formEdit;
        }
        ?>
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

    const $inputSplashArt = $('#inputSplashArt');
    const form = $('form#submit');

    $inputSplashArt.addEventListener('input', () => {
        getSrcFromInput($('#imgSplashArt'), $inputSplashArt);
    });

    <?php
    if ($edit === 'add') {
    ?>
        $("button[type='reset']").addEventListener('click', (e) => {
            $imagePosition.style.backgroundImage = "";
            $('#imgSplashArt').src = "";
            $('#videoAnimatedSplashArt').src = "";
        });
    <?php
    } elseif ($edit === 'update') {
    ?>
        $("button[type='reset']").addEventListener('click', (e) => {
            form.reset();
            getSrcFromInput($('#imgSplashArt'), $inputSplashArt);
        });
    <?php
    }
    ?>

    let value = $("button[type='submit']").value;

    confirmSubmit(form, $("button[type='submit']"), `Confirm ${value}?`);
</script>