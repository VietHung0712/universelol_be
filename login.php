<?php
require_once __DIR__ . "/src/config/config.php";
require_once __DIR__ . "/src/core/decrypt.php";
require_once __DIR__ . "/src/core/encrypt.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $config = new Config();
    $connect = $config->connect();

    $stmt = $connect->prepare("SELECT password FROM administrator WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $valid = false;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === decrypt($row['password'])) {
            $valid = true;
        }
    }

    if ($valid) {
        header("Location: ./src/views/index.php");
        exit();
    } else {
        echo "<script>alert('Incorrect username or password!');</script>";
    }

    $connect->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/VietHung0712/AssetsLOL/refs/heads/main/Icon/League_of_Legends_icon.svg">
    <link rel="stylesheet" href="./src/style/layout-admin.css">
    <title>Admin - Universe of League of Legends</title>
</head>

<body>
    <main style="margin-top: 0;">
        <form id="login" action="./login.php" method="POST">
            <table class="submit">
                <caption>Login</caption>
                <tr>
                    <th>Username</th>
                    <td>
                        <input type="text" name="username" placeholder="Username..." required>
                    </td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>
                        <input type="password" name="password" placeholder="Password..." required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">Login</button>
                    </td>
                </tr>
            </table>
        </form>
    </main>
</body>

</html>