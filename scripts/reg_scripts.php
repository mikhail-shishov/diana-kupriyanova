<?php

ini_set('display_errors', 1);

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST['last_name'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql =
        "INSERT INTO users (email, password, first_name, last_name) VALUES (:email, :password, :first_name, :last_name)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'email' => $email,
        'password' => $hashed_password,
        'first_name' => $first_name,
        'last_name' => $last_name
    ]);

    header("Location: ../welcome.php");
    exit();
}

