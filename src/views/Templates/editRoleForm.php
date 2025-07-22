<?php
require_once __DIR__ . "/editForm.php";

function editRoleForm($object, $caption, $button1, $button2, $readOnlyId = true )
{
    ob_start();
?>
    <form id="submit" method="POST" action="../controllers/editRoleController.php">
        <table class="submit table__tr">
            <caption><?= $caption; ?></caption>
            <tr>
                <th>Id</th>
                <td><input type="text" name="id" value="<?= $object->getId(); ?>" <?php if($readOnlyId) echo 'readOnly'; ?> required></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><input type="text" name="name" value="<?= $object->getName(); ?>" required></td>
            </tr>
            <tr>
                <th>Icon</th>
                <td>
                    <input class="inputSrc" type="url" name="icon" value="<?= $object->getIcon(); ?>" placeholder="Url..." required>
                </td>
            </tr>
            <tr>
                <th></th>
                <td><img class="outputSrc" height="200" width="300" src="<?= $object->getIcon(); ?>" alt=""></td>
            </tr>
            <tr>
                <th></th>
                <td></td>
            </tr>
            <tr>
                <th><?= $button1; ?></th>
                <td><?= $button2; ?></td>
            </tr>
        </table>
    </form>
<?php
    return ob_get_clean();
}

