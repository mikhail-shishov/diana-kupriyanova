<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userSystem = new User($pdo);

    $success = $userSystem->register(
        $_POST['email'],
        $_POST['password'],
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['tel']
    );

    if ($success) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Ошибка при регистрации, проверьте свои данные";
    }
}