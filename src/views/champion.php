<!DOCTYPE html>
<html lang="en">
<?php
try {
    require_once "../controllers/championController.php";
} catch (\Throwable $th) {
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <title><?php echo $this_champion->getName(); ?> - Admin</title>
</head>

<body>
    <?php require_once __DIR__ . "/Templates/header.php"; ?>
    <main>
        <div id="tools">
            <ul>
                <li>
                    <a href="./skins.php?champion=<?php echo $this_champion->getId(); ?>">Skins</a>
                </li>
                <li>
                    <a href="">Relations</a>
                </li>
            </ul>
        </div>
        <form id="submit" action="../controllers/championController.php" method="POST">
            <table id="submit" class="table__tr">
                <caption><?php echo $this_champion->getName(); ?></caption>
                <tr>
                    <th>Id</th>
                    <td>
                        <input type="text" value="<?php echo $this_champion->getId(); ?>" disabled>
                        <input type="hidden" name="id" value="<?php echo $this_champion->getId(); ?>">
                    </td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>
                        <input type="text" name="name" value="<?php echo $this_champion->getName(); ?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <th>Region</th>
                    <td>
                        <select name="region" disabled>
                            <?php
                            foreach ($regions as $value) {
                            ?>
                                <option <?php if ($value->getId() === $this_champion->getRegion()) echo "selected"; ?>
                                    value="<?php echo $value->getId(); ?>">
                                    <?php echo $value->getName(); ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>
                        <select name="role" disabled>
                            <?php
                            foreach ($roles as $value) {
                            ?>
                                <option <?php if ($value->getId() === $this_champion->getRole()) echo "selected"; ?>
                                    value="<?php echo $value->getId(); ?>">
                                    <?php echo $value->getName(); ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>
                        <input type="text" name="title" value="<?php echo $this_champion->getTitle(); ?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <th>Voice</th>
                    <td>
                        <input type="text" name="voice" value="<?php echo $this_champion->getVoice(); ?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <th>Story</th>
                    <td>
                        <textarea name="story" required readonly><?php echo $this_champion->getStory(); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Splash Art</th>
                    <td>
                        <input id="inputSplashArt" type="url" name="splash_art" value="<?php echo $this_champion->getSplashArt(); ?>" placeholder="url..." required readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><img id="imgSplashArt" height="200" width="300" src="<?php echo $this_champion->getSplashArt(); ?>" alt="Splash Art"></td>
                </tr>
                <tr>
                    <th>Animated Splash Art</th>
                    <td>
                        <input id="inputAnimatedSplashArt" type="url" name="animated_splash_art" value="<?php echo $this_champion->getAnimatedSplashArt(); ?>" placeholder="url..." readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><video id="videoAnimatedSplashArt" height="200" width="300" autoplay muted loop src="<?php echo $this_champion->getAnimatedSplashArt(); ?>"></video></td>
                </tr>
                <tr>
                    <th>Position(X,Y)</th>
                    <td>
                        <input id="inputPositionX" type="number" name="positionX" min="0" max="100" value="<?php echo $this_champion->getPositionX(); ?>" required readonly>
                        <input id="inputPositionY" type="number" name="positionY" min="0" max="100" value="<?php echo $this_champion->getPositionY(); ?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <div id="imagePosition"
                            style="background-image: url(<?php echo $this_champion->getSplashArt(); ?>); background-position-x: <?php echo $this_champion->getPositionX(); ?>%; background-position-y: <?php echo $this_champion->getPositionY(); ?>%;">

                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Model 3D</th>
                    <td>
                        <input type="url" name="model" value="<?php echo $this_champion->getModel(); ?>" placeholder="url..." readonly>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <model-viewer
                            src="<?php echo $this_champion->getModel(); ?>"
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
                        <input type="date" name="release_date" value="<?php echo $this_champion->getReleaseDate(); ?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <th>Updated Date</th>
                    <td>
                        <input type="date" name="updated_date" value="<?php echo $this_champion->getUpdatedDate(); ?>" required readonly>
                    </td>
                </tr>
                <tr>
                    <th><button id="btnOpenUpdate" type="button">Update</button></th>
                    <td id="tdAction" style="visibility: hidden;">
                        <button id="btnUpdate" type="submit" name="action" value="update">Save</button>
                        <button type="reset">Reset</button>
                    </td>
                </tr>
                <tr>
                    <th>
                        <button id="btnDel" type="submit" name="action" value="delete">Delete</button>
                    </th>
                </tr>
            </table>
        </form>
    </main>
</body>

</html>

<script type="module">
    import {
        $,
        $$,
        confirmSubmit
    } from "../js/functions.js";

    import {
        initEditChampion
    } from '../js/editchampion.js';

    const $btnOpenUpdate = $('#btnOpenUpdate');

    let checkUp = false;

    $btnOpenUpdate.addEventListener('click', () => {
        if (!checkUp) {
            $$('input').forEach(el => el.readOnly = false);
            $('textarea').readOnly = false;
            $$('select').forEach(el => el.disabled = false);
            $('#tdAction').style.visibility = 'visible';
            $btnOpenUpdate.textContent = 'Cancel';
        } else {
            $$('input').forEach(el => el.readOnly = true);
            $('textarea').readOnly = true;
            $$('select').forEach(el => el.disabled = true);
            $('#tdAction').style.visibility = 'hidden';
            $btnOpenUpdate.textContent = 'Update';
        }
        checkUp = !checkUp;
    });

    initEditChampion();

    confirmSubmit($('form#submit'), $('#btnUpdate'), "Confirm update?");
    confirmSubmit($('form#submit'), $('#btnDel'), "Confirm delete?");
</script>