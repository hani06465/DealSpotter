<?php
require_once __DIR__ . "/../models/User.php";


class AuthController {

    public function register(){
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        require "../app/views/auth/register.php";
    }

    public function store(){
        $user = new User();

        // CSRF checking
        if ($_POST['csrf'] !== $_SESSION['csrf']) {
            die("Invalid request");
        }


        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm_password']);


        // Validation
        // cheks if all the fields are filled
        if (empty($name) || empty($email) || empty($password)|| empty($confirmPassword)) {
            echo "All fileds requied! ";
            return;
        }

        // checks if the email is valid email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email";
            return;
        }

        // checks if the password is at least 6 chars:
        if (strlen($password) < 6) {
            echo "Password must be at least 6 characters!";
            return;
        }

        // checks if the password is correct or match it with the confirmation password
        if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        return;
    }

        // this will make sure if our email is unique, by queriying the database
        if($user->emailExists($email)){
            echo "Email already exists";
            return;
        }

        $user->register($name,$email,$password);

        header("Location: index.php?controller=auth&action=login");
    }

    public function login() {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        require "../app/views/auth/login.php";
    }

    public function authenticate() {
        $userModel = new User();

        // CSRF-checking
        if ($_POST['csrf'] !== $_SESSION['csrf']) {
            die("Invalid request");
        }


        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (empty($email) || empty($password)) {
            echo "All fileds requied!";
            return;
        }
        $user = $userModel->getByEmail($email);

        if ($user && password_verify($password,$user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            header("Location: index.php");
        } else {
            echo "Invalid email or password!";
        }

        return header("Location: index.php?controller=deal&action=index");
    }

    public function logout(){
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
    }
}