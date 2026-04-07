<?php
session_start();

require_once __DIR__ . '/db/db.php';
require_once __DIR__ . '/classes/User.php';

if (!isset($_SESSION['user_id'])){
    header(header:"Location: index.php");
    exit();
}

$userSystem = new User($pdo);
$userData = $userSystem->getById($_SESSION['user_id']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Добро пожаловать, <?php echo htmlspecialchars($userData['first_name']) ?></h1>
    <a href="handlers/logout.php">выйти из профиля</a>
</body>
</html>