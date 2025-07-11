<?php
require_once __DIR__ . "/editForm.php";

function editSkinForm($object, $caption, $championId, $button, $readOnlyId = false)
{
    ob_start();
?>
    <form id="submit" method="POST" action="../controllers/editSkinController.php">
        <table class="submit table__tr">
            <caption><?= $caption; ?></caption>
            <tr>
                <th>Id</th>
                <td><input type="text" name="id" value="<?= $object->getId(); ?>" required <?php if ($readOnlyId) echo 'readOnly'; ?>></td>
            </tr>
            <tr>
                <th>Champion</th>
                <td><input type="text" name="champion_id" value="<?= $championId; ?>" readonly required></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><input type="text" name="name" value="<?= $object->getName(); ?>" required></td>
            </tr>
            <tr>
                <th>Splash Art</th>
                <td>
                    <input id="inputSplashArt" type="url" name="splash_art" value="<?= $object->getSplashArt(); ?>" placeholder="url..." required>
                </td>
            </tr>
            <tr>
                <th></th>
                <td><img id="imgSplashArt" height="200" width="300" src="<?= $object->getSplashArt(); ?>" alt=""></td>
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
