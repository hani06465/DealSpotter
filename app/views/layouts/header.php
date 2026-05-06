<!DOCTYPE html>
<html>
<head>
    <title>DealSpotter</title>

    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #eef1f5;
}

.navbar {
    background: #1f2937;
    padding: 15px;
    color: white;
    display: flex;
    justify-content: ;
}

.navbar a {
    color: white;
    margin-right: 15px;
    text-decoration: none;
    font-weight: bold;
}

.container {
    width: 85%;
    margin: auto;
    margin-top: 20px;
}

.card {
    background: white;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    transition: 0.2s;
}

.card:hover {
    transform: scale(1.01);
}

.btn {
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    margin-right: 5px;
}

.btn-edit { background: #f59e0b; color: white; }
.btn-delete { background: #ef4444; color: white; }
.btn-status { background: #10b981; color: white; }
.btn:hover { opacity: 0.85; }

img {
    border-radius: 8px;
}
</style>

</head>
<body>

<div class="navbar">

   <a href="index.php?controller=deal&action=index">Home</a>
   <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
    <a href="index.php?controller=suggestion&action=index">Suggestions</a>
    <?php endif; ?>
    <?php if(isset($_SESSION['user_id'])): ?>
    <a href="index.php?controller=user&action=profile">My Profile</a>
<?php endif; ?>


    <?php if(isset($_SESSION['user_id'])): ?>
        <a href="index.php?controller=suggestion&action=create">Contact us</a>
        <a href="index.php?controller=deal&action=create">Add Deal</a>
        <a href="index.php?controller=auth&action=logout">Logout</a>
    <?php else: ?>
        <a href="index.php?controller=auth&action=login">Login</a>
        <a href="index.php?controller=auth&action=register">Register</a>
    <?php endif; ?>

</div>

<div class="container">