<?php

function editchampionForm($regions, $roles, $object, $caption, $button1, $button2)
{
    ob_start();
?>
    <form id="submit" method="POST" action="../controllers/editChampionController.php">
        <table class="submit table__tr">
            <caption><?= $caption; ?></caption>
            <tr>
                <th>Id</th>
                <td><input type="text" name="id" value="<?= $object->getId(); ?>" required></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><input type="text" name="name" value="<?= $object->getName(); ?>" required></td>
            </tr>
            <tr>
                <th>Region</th>
                <td><?php editSelect($regions, "region", $object->getRegion()); ?></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><?php editSelect($roles, "role", $object->getRole()); ?></td>
            </tr>
            <tr>
                <th>Title</th>
                <td>
                    <input type="text" name="title" value="<?php echo $object->getTitle(); ?>" required>
                </td>
            </tr>
            <tr>
                <th>Voice</th>
                <td>
                    <input type="text" name="voice" value="<?php echo $object->getVoice(); ?>" required>
                </td>
            </tr>
            <tr>
                <th>Story</th>
                <td>
                    <textarea name="story" required><?php echo $object->getStory(); ?></textarea>
                </td>
            </tr>
            <tr>
                <th>Splash Art</th>
                <td>
                    <input id="inputSplashArt" type="url" name="splash_art" value="<?php echo $object->getSplashArt(); ?>" placeholder="url..." required>
                </td>
            </tr>
            <tr>
                <th></th>
                <td><img id="imgSplashArt" height="200" width="300" src="<?php echo $object->getSplashArt(); ?>" alt=""></td>
            </tr>
            <tr>
                <th>Animated Splash Art</th>
                <td>
                    <input id="inputAnimatedSplashArt" type="url" name="animated_splash_art" value="<?php echo $object->getAnimatedSplashArt(); ?>" placeholder="url...">
                </td>
            </tr>
            <tr>
                <th></th>
                <td><video id="videoAnimatedSplashArt" height="200" width="300" autoplay muted loop src="<?php echo $object->getAnimatedSplashArt(); ?>"></video></td>
            </tr>
            <tr>
                <th>Position(X,Y)</th>
                <td>
                    <input id="inputPositionX" type="number" name="positionX" min="0" max="100" value="<?php echo $object->getPositionX(); ?>" required>
                    <input id="inputPositionY" type="number" name="positionY" min="0" max="100" value="<?php echo $object->getPositionY(); ?>" required>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <div id="imagePosition"
                        style="background-image: url(<?php echo $object->getSplashArt(); ?>); background-position-x: <?php echo $object->getPositionX(); ?>%; background-position-y: <?php echo $object->getPositionY(); ?>%;">
                    </div>
                </td>
            </tr>
            <tr>
                <th>Model 3D</th>
                <td>
                    <input type="url" name="model" value="<?php echo $object->getModel(); ?>" placeholder="url...">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <model-viewer
                        src="<?php echo $object->getModel(); ?>"
                        alt="Model 3D"
                        animation-name="Idle1.anm"
                        autoplay
                        camera-controls
                        ar
                        shadow-intensity="1">
                    </model-viewer>
                </td>
            </tr>
            <tr>
                <th>Release Date</th>
                <td>
                    <input type="date" name="release_date" value="<?php echo $object->getReleaseDate(); ?>" required>
                </td>
            </tr>
            <tr>
                <th>Updated Date</th>
                <td>
                    <input type="date" name="updated_date" value="<?php echo $object->getUpdatedDate(); ?>" required>
                </td>
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


function editSelect($array, $str, $id)
{
    echo "
<select name=\"$str\">";
    foreach ($array as $value) {
        $selected = "";
        if ($value->getId() === $id) $selected = "selected";
        echo '<option value="' . $value->getId() . '"' . $selected . '>' . $value->getName() . '</option>';
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

function btnChange($id): string
{
    return "<button><a href='./editChampion.php?edit=update&champion=" . $id . "'>Update</a></button>";
}
