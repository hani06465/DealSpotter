<?php


require_once __DIR__ . "/../../config/db.php";

class User{

// since we make our database_table users to unique emails it handles repetitive emails but to make sure and to handle it nicely we add this function:

   public function emailExists($email) {
        global $conn;

        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function register($name, $email, $password) {
        global $conn;
// here for security purpose we have to hashed our uses password when we store in our database: 
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed);

        return $stmt->execute();
    }

   public function getByEmail($email) {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getById($id) {
    global $conn;

    $stmt = $conn->prepare("SELECT id, name, email, created_at FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
    }

    // to get all the users for the admin profile:
    public function getAllUsers() {
    global $conn;

    return $conn->query("
        SELECT id, name, email 
        FROM users 
        WHERE role = 'user'
        ORDER BY id DESC
    ");
}

    // delete users account if needed by the admin:
    public function deleteUser($id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    return $stmt->execute();
    }

    
}