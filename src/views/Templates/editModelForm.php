<?php
require_once __DIR__ . "/editForm.php";

function editModelForm($object, $skins, $caption, $championId, $button, $readOnlyId = false)
{
    ob_start();
?>
    <form id="submit" method="POST" action="../controllers/editModelController.php">
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
                <th>Skin</th>
                <td>
                    <select name="skin_id">
                        <option value="0">Default</option>
                        <?php
                        foreach ($skins as $value) {
                            $selected = '';
                            if ($value->getId() === $object->getSkinId()) $selected = "selected";
                        ?>
                            <option value="<?php echo $value->getId(); ?>" <?php echo $selected; ?>><?php echo $value->getName(); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Poster</th>
                <td><input type="text" name="poster" value="<?= $object->getPoster(); ?>"></td>
            </tr>
            <tr>
                <th>Model 3D</th>
                <td>
                    <input type="url" name="model" value="<?= $object->getModel(); ?>" placeholder="Url...">
                </td>
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
