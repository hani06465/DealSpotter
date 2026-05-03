<h2>Login</h2>

<form method="POST" action="index.php?controller=auth&action=authenticate">
    <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">

    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>

    <button type="submit">Login</button>
</form>

<a href="index.php?controller=auth&action=register">Register</a>