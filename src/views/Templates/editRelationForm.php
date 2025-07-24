<?php
require_once __DIR__ . "/editForm.php";

function editRelationForm($champions, $object, $caption, $championId, $button, $readOnlyId = false)
{
    ob_start();
?>
    <form id="submit" method="POST" action="../controllers/editRelationController.php">
        <table class="submit table__tr">
            <caption><?= $caption; ?></caption>
            <tr>
                <th>Id</th>
                <td><input type="text" name="id" value="<?= $object->getId(); ?>" required <?php if ($readOnlyId) echo 'readOnly'; ?>></td>
            </tr>
            <tr>
                <th>Champion Id</th>
                <td><input type="text" name="champion_id" value="<?= $championId; ?>" readonly required></td>
            </tr>
            <tr>
                <th>Related Id</th>
                <td>
                    <?= editSelect($champions, 'related_id', $object->getRelated(), $championId); ?>
                </td>
            </tr>
            <tr>
                <th>Relation Type</th>
                <td>
                    <input type="text" name="relation_type" value="<?= $object->getRelationType(); ?>" placeholder="Relation Type...">
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
