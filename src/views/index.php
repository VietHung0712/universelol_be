<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Others/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="../style/layout-admin.css">
    <title>Admin</title>
</head>

<body>
    <?php require_once __DIR__ . "/Templates/header.php"; ?>
    <main>
        <div class="container">
            <a class="thumbex" href="./champions.php">
                <div class="thumbnail">
                    <img src="https://cdn1.epicgames.com/offer/24b9b5e323bc40eea252a10cdd3b2f10/EGS_LeagueofLegends_RiotGames_S1_2560x1440-80471666c140f790f28dff68d72c384b" />
                    <span>Champions</span>
                </div>
            </a>

            <a class="thumbex" href="./regions.php">
                <div class="thumbnail">
                    <img src="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Others/Runeterra_Terrain_map.webp" />
                    <span>Regions</span>
                </div>
            </a>

            <a class="thumbex" href="./roles.php">
                <div class="thumbnail">
                    <img src="https://cdnb.artstation.com/p/assets/images/images/017/480/571/large/samuel-thompson-icons-2.jpg?1556144654" />
                    <span>Roles</span>
                </div>
            </a>
        </div>

        <div class="admin">
            <a href="./admin.php">Administrator</a>
        </div>
    </main>
    <?php require_once __DIR__ . "/Templates/footer.php"; ?>
</body>

</html>
<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
        width: 100%;
        margin-top: 10vh;
        justify-content: space-around;
        align-items: center;
    }

    .thumbex {
        display: block;
        padding: 0;
        width: 300px;
        height: 400px;
        border: 1px solid var(--color1-);
    }

    .thumbnail {
        position: relative;
        width: 100%;
        height: 100%;

        &:hover {
            img {
                filter: opacity(1) grayscale(0%);
            }

            &::after {
                width: 100%;
                height: 100%;
            }
        }

        &::after {
            position: absolute;
            content: "";
            width: 80%;
            height: 80%;
            border: 1px solid #fff;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: all 300ms ease-in-out;
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: opacity(1) grayscale(100%);
            transition: all 300ms ease-in-out;
        }

        span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: black;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px;
        }
    }

    .admin {
        position: absolute;
        bottom: 5%;
        left: 5%;
    }
</style>