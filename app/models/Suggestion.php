<?php
require_once "../config/db.php";

class Suggestion {

    public function create($user_id, $message) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO suggestions (user_id, message) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $message);

        return $stmt->execute();
    }

    public function getAll() {
        global $conn;

        return $conn->query("
            SELECT suggestions.*, users.name 
            FROM suggestions 
            JOIN users ON suggestions.user_id = users.id
            ORDER BY suggestions.created_at DESC
        ");
    }
}