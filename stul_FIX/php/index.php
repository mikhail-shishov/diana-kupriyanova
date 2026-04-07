<?php
    require_once __DIR__ . '/db/db.php';
    require_once __DIR__ . '/classes/User.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="handlers/register.php" method="post">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Пароль">
        <input type="text" name="first_name" placeholder="Имя">
        <input type="text" name="last_name" placeholder="Фамилия">
        <input type="tel" name="tel" placeholder="Телефон">

        <button type="submit">0тправить</button>

        <a href="login.php">уже есть аккаунт</a>
    </form>
</body>
</html>