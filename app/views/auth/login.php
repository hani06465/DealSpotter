<?php require "../app/views/layouts/header.php"; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .login-container {
        max-width: 420px;
        margin: 80px auto;
        padding: 0 15px;
    }

    h2 {
        text-align: center;
        color: #1f2937;
        margin-bottom: 30px;
        font-size: 28px;
    }

    form {
        background: white;
        padding: 40px 30px;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    form input[type="email"],
    form input[type="password"] {
        width: 100%;
        padding: 14px 16px;
        margin-bottom: 20px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 16px;
        box-sizing: border-box;
        transition: all 0.3s;
    }

    form input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        outline: none;
    }

    form button {
        width: 100%;
        padding: 14px;
        background: #3b82f6;
        color: white;
        font-size: 16px;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
    }

    form button:hover {
        background: #2563eb;
        transform: translateY(-2px);
    }

    .form-footer {
        text-align: center;
        margin-top: 20px;
    }

    .form-footer a {
        color: #3b82f6;
        text-decoration: none;
    }

    .form-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-container">
    <h2>Login</h2>

    <form method="POST" action="index.php?controller=auth&action=authenticate">
        
        <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">

        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>

    <div class="form-footer">
        <p>Don't have an account? <a href="index.php?controller=auth&action=register">Register here</a></p>
    </div>
</div>

<?php require "../app/views/layouts/footer.php"; ?>