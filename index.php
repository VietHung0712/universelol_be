<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ./login.php");
    exit();
}
require_once __DIR__ . "/src/config/config.php";
try {
    $config = new Config();
    $connect = $config->connect();
    $connect->close();
    header("Location: ./login.php");
    exit();
} catch (\Throwable $th) {
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>League of Legends</title>
</head>
<style>
    body {
        height: 100vh;
        margin: 0;
        display: grid;
        place-items: center;
        overflow: hidden;
        background-color: #212121;
    }

    h1 {
        color: #fff;
    }

    .loader {
        display: flex;
        width: 8rem;
        height: 8rem;
        justify-content: center;
        align-items: center;
        position: relative;
        flex-direction: column;
    }

    .curve {
        width: 180%;
        height: 180%;
        position: absolute;
        animation: rotate 8s linear infinite;
        fill: transparent;
    }

    .curve text {
        fill: white;
        letter-spacing: 20px;
        text-transform: uppercase;
        font: 1.5em "Fira Sans", sans-serif;
        filter: drop-shadow(0 2px 8px black);
    }

    .blackhole {
        display: flex;
        position: absolute;
        width: 8rem;
        height: 8rem;
        align-items: center;
        justify-content: center;
        z-index: -1;
    }

    .circle {
        z-index: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center,
                black 25%,
                white 35%,
                white 100%);
        border-radius: 50%;
        box-shadow: 0px 0px 2rem #c2babb;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .circle::after {
        z-index: 0;
        position: absolute;
        content: "";
        width: 100%;
        height: 100%;
        border: 4px solid white;
        border-radius: 50%;
        background: radial-gradient(circle at center,
                black 35%,
                white 60%,
                white 100%);
        box-shadow: 0px 0px 5rem #c2babb;
        filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .circle::before {
        z-index: 1;
        content: "";
        display: flex;
        top: 5rem;
        width: 4rem;
        height: 4rem;
        border: 2px solid #ffffff;
        box-shadow:
            3px 3px 10px #c2babb,
            inset 0 0 1rem #ffffff;
        border-radius: 50%;
        filter: blur(0.5px);
        animation: rotate linear infinite 3s;
    }

    .disc {
        position: absolute;
        z-index: 0;
        display: flex;
        width: 5rem;
        height: 10rem;
        border-radius: 50%;
        background: radial-gradient(circle at center,
                #ffffff 80%,
                #353535 90%,
                white 100%);
        filter: blur(1rem) brightness(130%);
        border: 1rem solid white;
        box-shadow: 0px 0px 3rem #d7c4be;
        transform: rotate3d(1, 1, 1, 220deg);
        justify-content: center;
        align-items: center;
    }

    .disc::before {
        content: "";
        position: absolute;
        z-index: 0;
        display: flex;
        width: 5rem;
        height: 10rem;
        background: radial-gradient(circle at center, #ffffff 80%, #353535 90%, white 100%);
        border-radius: 50%;
        filter: blur(3rem);
        border: 1rem solid white;
        box-shadow: 0px 0px 6rem #d7c4be;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<body>
    <h1>Error: Data not found!</h1>
    <div class="loader">
        <div class="blackhole">
            <div class="circle"></div>
            <div class="disc"></div>
        </div>

        <div class="curve">
            <svg viewBox="0 0 500 500">
                <path id="loading" d="M73.2,148.6c4-6.1,65.5-96.8,178.6-95.6c111.3,1.2,170.8,90.3,175.1,97"></path>
                <text width="500">
                    <textPath xlink:href="#loading">
                        loading...
                    </textPath>
                </text>
            </svg>
        </div>
    </div>
</body>

</html>