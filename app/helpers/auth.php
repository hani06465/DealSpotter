<?php

// authentication helper functions:

// checks if the user is logged in:
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        die("Login required");
    }
}

// checks if the user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// checks if the user is the owner of the deal or the posted item
function isOwner($deal) {
    return $_SESSION['user_id'] == $deal['user_id'];
}  