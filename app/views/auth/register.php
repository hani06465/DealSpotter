<h2>Register</h2>

<form method="POST" action="index.php?controller=auth&action=store">
    <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">

    <input type="text" name="name" placeholder="Name"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <input type="password" name="confirm_password" placeholder="Confirm Password"><br><br>

    <button type="submit">Register</button>
</form>

<a href="index.php?controller=auth&action=login">Login</a>