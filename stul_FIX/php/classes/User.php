<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../db/db.php';

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($email, $password, $first_name, $last_name, $tel) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password, first_name, last_name, tel) VALUES (:email, :password, :first_name, :last_name, :tel)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'email' => $email,
            'password' => $hashed_password,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'tel' => $tel
        ]);
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function getById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}



//CREATE TABLE articles (
//    id INT AUTO_INCREMENT PRIMARY KEY,
//      user_id INT NOT NULL,
//      title VARCHAR(255) NOT NULL,
//      content TEXT NOT NULL,
//      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
//)