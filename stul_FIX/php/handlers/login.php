<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userSystem = new User($pdo);
    $userData = $userSystem->login($email, $password);

    if ($userData) {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_email'] = $userData['email'];
        $_SESSION['user_first_name'] = $userData['first_name'];

        header("Location: ../profile.php");
        exit();
    } else {
        die("Неверный email или пароль");
    }
} else {
    header("Location: ../index.php");
    exit();
}