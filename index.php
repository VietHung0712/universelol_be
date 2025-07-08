<?php
require_once "./src/config/config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $config = new Config();
    $connect = $config->connect();
    $sql = "SELECT * FROM administrator WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($connect, $sql);
    if ($result->num_rows > 0) {
        header("Location: ./src/views/champions.php");
        exit();
    } else {
?>
        <script>
            alert("Incorrect username or password!");
        </script>
<?php
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
        <form id="login" action="#" method="POST">
            <table class="submit">
                <caption>Login</caption>
                <tr>
                    <th>Username</th>
                    <td>
                        <input type="text" name="username" placeholder="Username" required>
                    </td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>
                        <input type="password" name="password" id="inputPass" placeholder="Password" required>
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