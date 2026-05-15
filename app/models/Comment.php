<?php
require_once "../config/db.php";

class Comment {

    public function create($user_id, $deal_id, $comment) {
        global $conn;

        $stmt = $conn->prepare("
            INSERT INTO comments (user_id, deal_id, comment)
            VALUES (?, ?, ?)
        ");

        $stmt->bind_param("iis", $user_id, $deal_id, $comment);

        return $stmt->execute();
    }

    public function getByDeal($deal_id) {
        global $conn;

        $stmt = $conn->prepare("
            SELECT comments.*, users.name
            FROM comments
            JOIN users ON comments.user_id = users.id
            WHERE deal_id = ?
            ORDER BY comments.created_at DESC
        ");

        $stmt->bind_param("i", $deal_id);
        $stmt->execute();

        return $stmt->get_result();
    }


}