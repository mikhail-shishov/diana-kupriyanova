<?php
session_start();

// очистка сессии
$_SESSION = [];

// уничтожение сессии
session_destroy();

$_SESSION['message'] = "Вы успешно вышли";

header("Location: ../login.php");
exit();