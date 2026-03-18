<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Логин</title>
</head>
<body>

<?php
    session_start();
    if (isset($_SESSION['message'])) {
        echo "<div>Вы успешно вышли</div>";
        unset($_SESSION['message']);
    }
?>

<h1>Логин</h1>
<form action="scripts/login_scripts.php" method="post">
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Пароль">

    <button type="submit">Войти</button>
</form>

</body>
</html>
