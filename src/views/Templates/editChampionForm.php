<?php
require_once __DIR__ . "/editForm.php";

function editChampionForm($regions, $roles, $object, $caption, $button1, $button2, $readOnlyId = true)
{
    ob_start();
?>
    <form id="submit" method="POST" action="../controllers/editChampionController.php">
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
                <th>Region</th>
                <td><?= editSelect($regions, "region", $object->getRegion()); ?></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><?= editSelect($roles, "role", $object->getRole()); ?></td>
            </tr>
            <tr>
                <th>Title</th>
                <td>
                    <input type="text" name="title" value="<?= $object->getTitle(); ?>" required>
                </td>
            </tr>
            <tr>
                <th>Voice</th>
                <td>
                    <input type="text" name="voice" value="<?= $object->getVoice(); ?>" required>
                </td>
            </tr>
            <tr>
                <th>Story</th>
                <td>
                    <textarea name="story" required><?= $object->getStory(); ?></textarea>
                </td>
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
                <th>Animated Splash Art</th>
                <td>
                    <input id="inputAnimatedSplashArt" type="url" name="animated_splash_art" value="<?= $object->getAnimatedSplashArt(); ?>" placeholder="url...">
                </td>
            </tr>
            <tr>
                <th></th>
                <td><video id="videoAnimatedSplashArt" height="200" width="300" autoplay muted loop src="<?= $object->getAnimatedSplashArt(); ?>"></video></td>
            </tr>
            <tr>
                <th>Position(X,Y)</th>
                <td>
                    <input id="inputPositionX" type="number" name="positionX" min="0" max="100" value="<?= $object->getPositionX(); ?>" required>
                    <input id="inputPositionY" type="number" name="positionY" min="0" max="100" value="<?= $object->getPositionY(); ?>" required>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <div id="imagePosition"
                        style="background-image: url(<?= $object->getSplashArt(); ?>); background-position-x: <?= $object->getPositionX(); ?>%; background-position-y: <?= $object->getPositionY(); ?>%;">
                    </div>
                </td>
            </tr>
            <tr>
                <th>Model 3D</th>
                <td>
                    <input type="url" name="model" value="<?= $object->getModel(); ?>" placeholder="url...">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <model-viewer
                        src="<?= $object->getModel(); ?>"
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
                    <input type="date" name="release_date" value="<?= $object->getReleaseDate(); ?>" required>
                </td>
            </tr>
            <tr>
                <th>Updated Date</th>
                <td>
                    <input type="date" name="updated_date" value="<?= $object->getUpdatedDate(); ?>" required>
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

