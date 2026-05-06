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

    if ($_SESSION['role'] == 'admin') {
        $users = $userModel->getAllUsers();
    } else {
        $deals = $dealModel->getByUser($_SESSION['user_id']);
    }

    require "../app/views/users/profile.php";
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

    public function deleteUser() {
    requireLogin();

    if ($_SESSION['role'] != 'admin') {
        die("Access denied");
    }

    $id = $_GET['id'];

    // prevent admin deleting himself
    if ($id == $_SESSION['user_id']) {
        die("You cannot delete yourself");
    }

    $userModel = new User();
    $userModel->deleteUser($id);

    $_SESSION['success'] = "User deleted successfully!";

    header("Location: index.php?controller=user&action=profile");
}

public function edit() {

        requireLogin();
        $users = new User();
        $user = $users->getById($_SESSION['user_id']);

        
        require "../app/views/users/edit.php";
    }
}