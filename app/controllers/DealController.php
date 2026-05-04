<?php

require_once "../app/helpers/auth.php";
require_once "../app/models/Deal.php";


class DealController {

// for showing all the deals
  public function index() {
    $dealModel = new Deal();

    if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
        $keyword = trim($_GET['search']);
        $deals = $dealModel->search($keyword);
    } else {
        $deals = $dealModel->getAll();
    }

    require "../app/views/deals/index.php";
}


// for showing the form for creating a deal
   public function create() {
        if (!isset($_SESSION['user_id'])) {
            die("Login required");
        }

        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        require "../app/views/deals/create.php";
    }


// for storing the created deal in the deal database:
     public function store() {

        requireLogin();

        if ($_POST['csrf'] !== $_SESSION['csrf']) {
            die("Invalid request");
        }

        $dealModel = new Deal();

        //  For clean input
        $item_name  = trim($_POST['item_name']);
        $price      = trim($_POST['price']);
        $store_name = trim($_POST['store_name']);
        $phone      = trim($_POST['phone']);
        $location   = trim($_POST['location']);

    // checks if all the input fileds are filled
        if (empty($item_name) || empty($price) || empty($store_name) || empty($phone) || empty($location)) {
            echo "All fields are required!";
            return;
        }
    // checks for us if the phone number is only numeric
        if (!is_numeric($price)) {
            echo "Price must be numeric!";
            return;
        }
    // checks the length of our digits
        if (!preg_match('/^[0-9]{10,12}$/', $phone)) {
            echo "Invalid phone!";
            return;
        }

    // if image is filed

        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
            echo "Image required!";
            return;
        }

        $image_name = $_FILES['image']['name'];
        $tmp_name   = $_FILES['image']['tmp_name'];

        $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowed)) {
            echo "Only JPG, JPEG, PNG allowed!";
            return;
        }

// Rename file 
        $new_name = time() . "_" . rand(1000,9999) . "." . $ext;
        move_uploaded_file($tmp_name, "../uploads/" . $new_name);

        $dealModel->create(
            $_SESSION['user_id'],
            $item_name,
            $price,
            $store_name,
            $phone,
            $location,
            $new_name
        );
        $_SESSION['success'] = "Deal added successfully!"; // gives us success message
        header("Location: index.php?controller=deal&action=index");
    }

// Edit-form displayed with infos found in the database
    public function edit() {

        requireLogin();
        $dealModel = new Deal();
        $deal = $dealModel->getById($_GET['id']);

        if (!$deal) {
        die("Deal not found");
        }
        // for checking the owner ship of teh deal:

        if ($_SESSION['user_id'] != $deal['user_id'] && $_SESSION['role'] != 'admin') {
            die("Access denied");
        }

        require "../app/views/deals/edit.php";
    }

// Update deal-created
    public function update() {

        requireLogin();

        $dealModel = new Deal();
        $deal = $dealModel->getById($_POST['id']);

        if (!$deal) {
        die("Deal not found");
        }

        // checks if the updater is the one that create the deal and not an admin:
        if ($_SESSION['user_id'] != $deal['user_id'] && $_SESSION['role'] != 'admin') {
            die("Access denied");
        }

        $dealModel->update(
            $_POST['id'],
            $_POST['item_name'],
            $_POST['price'],
            $_POST['store_name'],
            $_POST['phone'],
            $_POST['location']
        );
        $_SESSION['success'] = "Deal updated successfully!";
        header("Location: index.php?controller=deal&action=index");
    }

// Delete deal that created before:
    public function delete() {
        requireLogin();
        $dealModel = new Deal();

        $deal = $dealModel->getById($_GET['id']);
        if (!$deal) {
        die("Deal not found");
    }

        if ($_SESSION['user_id'] != $deal['user_id'] && $_SESSION['role'] != 'admin') {
            die("Access denied");
        }

        $dealModel->delete($_GET['id']);
        $_SESSION['success'] = "Deal deleted successfully!";
        header("Location: index.php?controller=deal&action=index");
    }

    public function changeStatus(){
        requireLogin();

        if (!isset($_GET['id']) || empty($_GET['id'])) {
        die("Invalid request (missing ID)");
        }

        $dealModel = new Deal();
        $deal = $dealModel->getById($_GET['id']);

        if (!$deal) {
        die("Deal not found");
        }

        if (!isOwner($deal) && !isAdmin()) {
        die("Access denied");
        }

        $status = $_GET['status'];

        if (!in_array($status, ['available','Unavailable'])) {
        die("Invalid status");
        }

        $dealModel->updateStatus($_GET['id'], $status);
    $_SESSION['success'] = "Deal status updated!";
    header("Location: index.php?controller=deal&action=index");

    }

}