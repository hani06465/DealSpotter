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

        header("Location: index.php?controller=comment&action=show&deal_id=" . $deal_id);
    }

    public function show() {

    require_once "../app/models/Deal.php";

    $deal_id = $_GET['deal_id'];

    $dealModel = new Deal();
    $commentModel = new Comment();

    $deal = $dealModel->getById($deal_id);

    if (!$deal) {
        die("Deal not found");
    }

    $comments = $commentModel->getByDeal($deal_id);

    require "../app/views/comments/show.php";
}

    
}