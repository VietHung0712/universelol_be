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
        <?php
        if (!empty($championId)) {
        ?>
            <div id="tools">
                <ul>
                    <li>
                        <a href="./skins.php?champion=<?php echo $this_champion->getId(); ?>">Skins</a>
                    </li>
                    <li>
                        <a href="">Relations</a>
                    </li>
                </ul>
            </div>
        <?php
        }
        echo $formEdit;
        ?>
    </main>
</body>

</html>


<script type="module">
    import {
        $,
        $$,
        confirmSubmit
    } from "../js/functions.js";

    import {
        initEditChampion
    } from '../js/editchampion.js';

    initEditChampion();

    let value = $("button[type='submit']").value;

    confirmSubmit($('form#submit'), $("button[type='submit']"), `Confirm ${value}?`);
</script>