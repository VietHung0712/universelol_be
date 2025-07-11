<!DOCTYPE html>
<html lang="en">
<?php
try {
    require_once __DIR__ . "/../controllers/editRegionController.php";
} catch (\Throwable $th) {
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <title>Edit Region</title>
</head>

<body>
    <?php require_once __DIR__ . "/Templates/header.php"; ?>
    <main>
        <div id="tools">
            <ul>
                <?php
                if (!empty($regionId)) {
                ?>
                    <li>
                        <a href="./editRegion.php?edit=update&region=<?php echo $regionId; ?>">Update</a>
                    </li>
                <?php
                }
                if ($edit === 'add') {
                ?>
                    <li>
                        <a href="">Regions</a>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </li>
                    <li>
                        <a href="./editRegion.php?edit=update&region=<?php echo $regionId; ?>">Add</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <?php
        echo $formEdit;
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

    const $$inputSrc = $$('.inputSrc');
    const $$outputSrc = $$('.outputSrc');
    const form = $('form#submit');

    $$inputSrc.forEach((el, i) => {
        el.addEventListener('input', () => {
            getSrcFromInput($$outputSrc[i], el);
        });
    });

    <?php
    if ($edit === 'details') {
    ?>
        const $$inputs = $$('input', form);

        $$inputs.forEach(element => {
            element.readOnly = true;
        });
        $('textarea', form).readOnly = true;
    <?php
    }
    if ($edit === 'add') {
    ?>
        $("button[type='reset']").addEventListener('click', (e) => {
            $$inputSrc.forEach((el, i) => {
                el.src = "";
            });
        });
    <?php
    } elseif ($edit === 'update') {
    ?>
        $("button[type='reset']").addEventListener('click', (e) => {
            form.reset();
            $$inputSrc.forEach((el, i) => {
                getSrcFromInput($$outputSrc[i], el);
            });
        });
    <?php
    }
    ?>

    let value = $("button[type='submit']").value;

    confirmSubmit(form, $("button[type='submit']"), `Confirm ${value}?`);
</script>