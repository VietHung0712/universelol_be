<?php
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../core/decrypt.php";
require_once __DIR__ . "/../core/encrypt.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $newPass = $_POST['newPassword'] ?? '';
    $otp = $_POST['otp'] ?? '';

    $config = new Config();
    $connect = $config->connect();

    $stmt = $connect->prepare("SELECT password FROM administrator WHERE username = ? AND otp = ?");
    $stmt->bind_param("ss", $username, $otp);
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
        $newEncryptedPassword = encrypt($newPass);
        $updateQuery = "UPDATE administrator SET password = ? WHERE username = ?";
        $updateStmt = $connect->prepare($updateQuery);
        $updateStmt->bind_param("ss", $newEncryptedPassword, $username);
        if ($updateStmt->execute()) {
            header("Location: ./index.php");
            exit();
        }
        echo "<script>alert('Incorrect username or password or OTP!');</script>";
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
    <link rel="stylesheet" href="../style/layout-admin.css">
    <title>Admin</title>
</head>

<body>
    <?php require_once __DIR__ . "/Templates/header.php"; ?>
    <main>
        <form id="login" action="./admin.php" method="POST">
            <table class="submit">
                <caption>Admin - Change password</caption>
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
                    <th>New Password</th>
                    <td>
                        <input type="password" minlength="8" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"
                            title="At least 8 characters, including uppercase letters, lowercase letters, and numbers" name="newPassword" placeholder="New password..." required>
                    </td>
                </tr>
                <tr>
                    <th>OTP</th>
                    <td>
                        <input type="password" name="otp" placeholder="OTP..." required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">Change</button>
                    </td>
                </tr>
            </table>
        </form>
    </main>
</body>

</html>