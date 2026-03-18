<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Hi</title>
</head>
<body>
    <h1>Hello, World</h1>
    <a href="scripts/logout_scripts.php">Выйти из профиля</a>
</body>
</html>