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
}