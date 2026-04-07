<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../db/db.php';

class Article {
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($user_id, $title, $content) {
        $sql = "INSERT INTO articles (user_id, title, content) VALUES (:user_id, :title, :content)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'title' => $title,
            'content' => $content
        ]);
    }
}
