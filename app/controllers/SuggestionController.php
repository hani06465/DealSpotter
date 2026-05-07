<?php
require_once "../app/models/Suggestion.php";
require_once "../app/helpers/auth.php";

class SuggestionController {

    public function create() {
        requireLogin();
        require "../app/views/suggestions/create.php";
    }

    public function store() {
        requireLogin();

        $message = trim($_POST['message']);

        if (empty($message)) {
            echo "Message cannot be empty!";
            return;
        }

        $suggestionModel = new Suggestion();
        $suggestionModel->create($_SESSION['user_id'], $message);

        $_SESSION['success'] = "Suggestion sent successfully!";
        header("Location: index.php?controller=deal&action=index");
    }

    // give us all the suggestion from the suggestion table:
    public function index() {
        requireLogin();

        if ($_SESSION['role'] !== 'admin') {
            die("Access denied");
        }

        $suggestionModel = new Suggestion();
        $suggestions = $suggestionModel->getAll();

        require "../app/views/suggestions/index.php";
    }
}