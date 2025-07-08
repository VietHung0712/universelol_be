<!DOCTYPE html>
<html lang="en">
<?php
try {
    require_once "../controllers/addChampionController.php";
} catch (\Throwable $th) {
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <title>Add champion - Admin</title>
</head>

<body>
    <?php require_once __DIR__ . "/Templates/header.php"; ?>
    <main>
        <form id="submit" method="POST" action="../controllers/addChampionController.php">
            <table class="submit table__tr">
                <caption>Add new champion</caption>
                <tr>
                    <th>Id</th>
                    <td>
                        <input type="text" name="id" required>
                    </td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>
                        <input type="text" name="name" required>
                    </td>
                </tr>
                <tr>
                    <th>Region</th>
                    <td>
                        <select name="region">
                            <?php
                            foreach ($regions as $value) {
                            ?>
                                <option
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
                        <select name="role">
                            <?php
                            foreach ($roles as $value) {
                            ?>
                                <option
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
                        <input type="text" name="title" required>
                    </td>
                </tr>
                <tr>
                    <th>Voice</th>
                    <td>
                        <input type="text" name="voice" required>
                    </td>
                </tr>
                <tr>
                    <th>Story</th>
                    <td>
                        <textarea name="story" required></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Splash Art</th>
                    <td style="display: flex; flex-direction: column;">
                        <input id="inputSplashArt" type="url" name="splash_art" required placeholder="Url...">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><img id="imgSplashArt" height="200" width="300" src="" alt=""></td>
                </tr>
                <tr>
                    <th>Animated Splash Art</th>
                    <td>
                        <input id="inputAnimatedSplashArt" type="url" name="animated_splash_art" placeholder="Url...">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><video id="videoAnimatedSplashArt" height="200" width="300" autoplay muted loop></video></td>
                </tr>
                <tr>
                    <th>Position(X,Y)</th>
                    <td>
                        <input id="inputPositionX" type="number" name="positionX" min="0" max="100" value="0" required>
                        <input id="inputPositionY" type="number" name="positionY" min="0" max="100" value="0" required>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><div id="imagePosition"></div></td>
                </tr>
                <tr>
                    <th>Model 3D</th>
                    <td>
                        <input type="url" name="model" placeholder="Url...">
                    </td>
                </tr>
                <tr>
                    <th>Release Date</th>
                    <td>
                        <input type="date" name="release_date" value="2009-04-21" required>
                    </td>
                </tr>
                <tr>
                    <th>Updated Date</th>
                    <td>
                        <input type="date" name="updated_date" value="2009-04-21" min="2009-04-21" required>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button type="submit">Add</button>
                        <button type="reset">Reset</button>
                    </td>
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

    initEditChampion();

    confirmSubmit($('form#submit'), $("button[type='submit']"), "Confirm add?");
</script>