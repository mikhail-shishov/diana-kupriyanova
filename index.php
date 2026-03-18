<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Главная</title>
</head>
<body>

<h1>Регистрация</h1>
<form action="scripts/reg_scripts.php" method="post">
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Пароль">
    <input type="text" name="first_name" placeholder="Имя">
    <input type="text" name="last_name" placeholder="Фамилия">

    <button type="submit">Отправить</button>
</form>
<hr>
<a href="login.php">Уже есть аккаунт? Тогда войдите в свой профиль</a>

</body>
</html>