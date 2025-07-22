<?php
function editSelect($array, $str, $this_id, ?string $object_id = null)
{
    echo "
    <select name=\"$str\">";
    foreach ($array as $value) {
        $selected = '';
        if ($value->getId() === $this_id) $selected = "selected";
        if (!empty($object_id)) {
            if ($object_id !== $value->getId()) {
                echo '<option value="' . $value->getId() . '" ' . $selected . '>' . $value->getName() . '</option>';
            }
        } else {
            echo '<option value="' . $value->getId() . '" ' . $selected . '>' . $value->getName() . '</option>';
        }
    }
    echo "</select>";
}

function btnDelete(): string
{
    return '<button id="btnDel" type="submit" name="action" value="delete">Delete</button>';
}

function btnUpdate(): string
{
    return '<button type="submit" name="action" value="update">Update</button>';
}

function btnAdd(): string
{
    return '<button type="submit" name="action" value="add">Add</button>';
}

function btnReset(): string
{
    return '<button type="reset">Reset</button>';
}
