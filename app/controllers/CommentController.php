<?php
require_once "../app/models/Comment.php";
require_once "../app/helpers/auth.php";

class CommentController {

    public function store() {
        requireLogin();

        $deal_id = $_POST['deal_id'];
        $comment = trim($_POST['comment']);

        if (empty($comment)) {
            die("Comment required");
        }

        $commentModel = new Comment();

        $commentModel->create(
            $_SESSION['user_id'],
            $deal_id,
            $comment
        );

        $_SESSION['success'] = "Comment added!";

        header("Location: index.php?controller=deal&action=index");
    }

    
}