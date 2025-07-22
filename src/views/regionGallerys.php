<!DOCTYPE html>
<html lang="en">
<?php
try {
    require_once "../controllers/regionGallerysController.php";
} catch (\Throwable $th) {
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <title><?php echo $this_region->getName(); ?> - Admin</title>
</head>

<body>
    <?php require_once __DIR__ . "/Templates/header.php"; ?>
    <main>
        <div id="tools">
            <ul>
                <li><a href="./regions.php">Regions</a></li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>
                </li>
                <?php
                if (!empty($regionId)) {
                ?>
                    <li>
                        <a
                            href="./editRegionGallery.php?edit=details&region=<?php echo $this_region->getId(); ?>">
                            <span><?php echo $this_region->getName(); ?></span>
                        </a>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </li>
                    <li>
                        <a href="./regionGallerys.php?region=<?php echo $this_region->getId(); ?>">Gallerys</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div id="addNew">
            <a
                href="./editRegionGallery.php?edit=add&region=<?php echo $this_region->getId(); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                </svg>
            </a>
        </div>

        <table id="list" class="table__tr">
            <caption><?php echo $this_region->getName(); ?>:<?php echo count($regionGallerys); ?></caption>
            <thead id="thead__pc">
                <th>Id</th>
                <th>Gallery</th>
            </thead>
            <tbody>
                <?php
                foreach ($regionGallerys as $key => $value) {
                ?>
                    <tr>
                        <th class="thead__mobile">Id</th>
                        <td>
                            <p><?php echo $value->getId(); ?></p>
                        </td>
                        <th class="thead__mobile">Gallery</th>
                        <td>
                            <input type="url" name="gallery" class="inputGallery" value="<?php echo $value->getGallery(); ?>" placeholder="Url..." required readonly>
                        </td>
                        <th></th>
                        <td>
                            <img class="imgGallery" height="200" width="300"
                                src="<?php echo $value->getGallery(); ?>" alt="">
                        </td>
                        <th>
                            <a
                                href="./editRegionGallery.php?edit=update&region=<?php echo $this_region->getId(); ?>&regionGallery=<?php echo $value->getId(); ?>">
                                Update
                            </a>
                        </th>
                        <td>

                            <form class="submit" method="POST"
                                action="../controllers/editRegionGalleryController.php">
                                <input type="hidden" name="id"
                                    value="<?php echo $value->getId(); ?>">
                                <input type="hidden" name="region_id"
                                    value="<?php echo $this_region->getId(); ?>">
                                <button class="btnDel" type="submit"
                                    name="action" value="delete">
                                    Delete
                                </button>
                            </form>
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
        confirmSubmit
    } from "../js/functions.js";

    const $$form = $$('form.submit');

    $$("button[type='submit'").forEach((el, i) => {
        let value = el.value;
        confirmSubmit($$form[i], el, `Confirm ${value}?`);
    });
</script>