<!DOCTYPE html>
<html lang="en">
<?php
try {
    require_once __DIR__ . "/../controllers/editRelationController.php";
} catch (\Throwable $th) {
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <title>Edit Relation</title>
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
                        <a style="text-decoration: none;"
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
                        <a href="./relations.php?champion=<?php echo $this_champion->getId(); ?>">Relations</a>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </li>
                    <li>
                        <a href=""><?php echo $edit ?></a>
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

    const form = $('form#submit');


    let value = $("button[type='submit']").value;

    confirmSubmit(form, $("button[type='submit']"), `Confirm ${value}?`);
</script>