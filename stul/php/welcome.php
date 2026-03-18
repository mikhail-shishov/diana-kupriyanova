<?php
session_start();

if (!isset($_SESSION['user_id'])){
    header(header:"Location: lodin.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hello, world</h1>
    <a href="scripts/logout_scripts.php">выйти из профиля</a>
</body>
</html>