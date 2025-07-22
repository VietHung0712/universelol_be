<!DOCTYPE html>
<html lang="en">
<?php
try {
    require_once __DIR__ . "/../controllers/editChampionController.php";
} catch (\Throwable $th) {
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <title>Edit Champion</title>
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
                <?php
                if ($edit === 'details' && !empty($championId)) {
                ?>
                    <li>
                        <a
                            href="./editChampion.php?edit=details&champion=<?php echo $this_champion->getId(); ?>">
                            <span><?php echo $this_champion->getName(); ?></span>
                        </a>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </li>
                    <li>
                        <a href="./editChampion.php?edit=update&champion=<?php echo $championId; ?>">Update</a>
                    </li>
                    <li>
                        <a href="./skins.php?champion=<?php echo $this_champion->getId(); ?>">Skins</a>
                    </li>
                    <li>
                        <a href="./models.php?champion=<?php echo $this_champion->getId(); ?>">Models</a>
                    </li>
                    <li>
                        <a href="./relations.php?champion=<?php echo $this_champion->getId(); ?>">Relations</a>
                    </li>
                <?php
                } elseif ($edit === 'update' && !empty($championId)) {
                ?>
                    <li>
                        <a
                            href="./editChampion.php?edit=details&champion=<?php echo $this_champion->getId(); ?>">
                            <span><?php echo $this_champion->getName(); ?></span>
                        </a>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </li>
                    <li>
                        <a href="./editChampion.php?edit=update&champion=<?php echo $this_champion->getId(); ?>">Update</a>
                    </li>
                <?php
                } elseif ($edit === 'add') {
                ?>
                    <li>
                        <a href="./editChampion.php?edit=add">Add</a>
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
    const $inputAnimatedSplashArt = $('#inputAnimatedSplashArt');
    const $imagePosition = $('#imagePosition');
    const $inputPositionX = $('#inputPositionX');
    const $inputPositionY = $('#inputPositionY');
    const form = $('form#submit');

    $inputSplashArt.addEventListener('input', () => {
        getSrcFromInput($('#imgSplashArt'), $inputSplashArt);
        $imagePosition.style.backgroundImage = `url(${$inputSplashArt.value.trim()})`;
    });

    $inputAnimatedSplashArt.addEventListener('input', () => {
        getSrcFromInput($('#videoAnimatedSplashArt'), $inputAnimatedSplashArt);
    });

    $inputPositionX.addEventListener('input', () => {
        $imagePosition.style.backgroundPositionX = `${$inputPositionX.value.trim()}%`;
    });

    $inputPositionY.addEventListener('input', () => {
        $imagePosition.style.backgroundPositionY = `${$inputPositionY.value.trim()}%`;
    });

    <?php
    if ($edit === 'details') {
    ?>
        const $$inputs = $$('input', form);
        const $$selects = $$('select', form);

        $$inputs.forEach(element => {
            element.readOnly = true;
        });
        $$selects.forEach(element => {
            element.disabled = true;
        });
        $('textarea', form).readOnly = true;
    <?php
    } elseif ($edit === 'add') {
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
            getSrcFromInput($('#videoAnimatedSplashArt'), $inputAnimatedSplashArt);
            $imagePosition.style.backgroundImage = `url(${$inputSplashArt.value.trim()})`;
            $imagePosition.style.backgroundPositionX = `${$inputPositionX.value.trim()}%`;
            $imagePosition.style.backgroundPositionY = `${$inputPositionY.value.trim()}%`;
        });
    <?php
    }
    ?>

    let value = $("button[type='submit']").value;

    confirmSubmit(form, $("button[type='submit']"), `Confirm ${value}?`);
</script>