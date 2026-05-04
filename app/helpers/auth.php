<?php

function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        die("Login required");
    }
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isOwner($deal) {
    return $_SESSION['user_id'] == $deal['user_id'];
}