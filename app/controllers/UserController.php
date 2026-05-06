<?php
require_once "../app/models/User.php";
require_once "../app/models/Deal.php";
require_once "../app/helpers/auth.php";

class UserController {

    public function profile() {
        requireLogin();

        $userModel = new User();
        $dealModel = new Deal();

        $user = $userModel->getById($_SESSION['user_id']);
        $deals = $dealModel->getByUser($_SESSION['user_id']);

        require "../app/views/users/profile.php";
    }

    public function edit() {
        requireLogin();

        $userModel = new User();
        $user = $userModel->getById($_SESSION['user_id']);

        require "../app/views/users/edit.php";
    }

    public function update() {
    requireLogin();
    global $conn;

    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (empty($name) || empty($email)) {
        echo "Name and Email are required!";
        return;
    }

    // 🔹 Update basic info
    $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $_SESSION['user_id']);
    $stmt->execute();

    // 🔒 PASSWORD PART (ONLY IF FILLED)
    $current = $_POST['current_password'] ?? '';
    $new     = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (!empty($current) || !empty($new) || !empty($confirm)) {

        if (empty($current) || empty($new) || empty($confirm)) {
            echo "Fill all password fields!";
            return;
        }

        if ($new !== $confirm) {
            echo "Passwords do not match!";
            return;
        }

        // get current password from DB
        $stmt = $conn->prepare("SELECT password FROM users WHERE id=?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        // verify current password
        if (!password_verify($current, $result['password'])) {
            echo "Current password is incorrect!";
            return;
        }

        // hash new password
        $hashed = password_hash($new, PASSWORD_DEFAULT);

        // update password
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->bind_param("si", $hashed, $_SESSION['user_id']);
        $stmt->execute();
    }

    $_SESSION['success'] = "Profile updated successfully!";

    header("Location: index.php?controller=user&action=profile");
}
}