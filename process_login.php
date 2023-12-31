<?php
session_start();

include("admin/connect.php");

$username = $_POST["username"];
$password = $_POST["password"];

$query = "SELECT * FROM user WHERE username = ? AND password = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$username, $password]);
$user = $stmt->fetch();

if ($user) {

    $_SESSION["user_id"] = $user["id"];

    setcookie("login_status", "true", time() + 3600, "/admin/");

    header("Location: /admin/index.php");
    exit;
} else {
    $_SESSION["login_error"] = "Đăng nhập không thành công. Vui lòng kiểm tra lại thông tin đăng nhập.";
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;
    header("Location: /login.php");
    exit;
}
?>