<?php
require_once __DIR__ . "/editForm.php";

function editRegionGalleryForm($object, $caption, $regionId, $button, $readOnlyId = false)
{
    ob_start();
?>
    <form id="submit" method="POST" action="../controllers/editRegionGalleryController.php">
        <table class="submit table__tr">
            <caption><?= $caption; ?></caption>
            <tr>
                <th>Id</th>
                <td><input type="text" name="id" value="<?= $object->getId(); ?>" required <?php if ($readOnlyId) echo 'readOnly'; ?>></td>
            </tr>
            <tr>
                <th>Region</th>
                <td><input type="text" name="region_id" value="<?= $regionId; ?>" readonly required></td>
            </tr>
            <tr>
                <th>Gallery</th>
                <td>
                    <input id="inputGallery" type="url" name="gallery" value="<?= $object->getGallery(); ?>" placeholder="url..." required>
                </td>
            </tr>
            <tr>
                <th></th>
                <td><img id="imgGallery" height="200" width="300" src="<?= $object->getGallery(); ?>" alt=""></td>
            </tr>
            <tr>
                <th></th>
                <td></td>
            </tr>
            <tr>
                <th><button type="reset">Reset</button></th>
                <td><?= $button; ?></td>
            </tr>
        </table>
    </form>
<?php
    return ob_get_clean();
}
