<?php require "../app/views/layouts/header.php"; ?>

<style>
.login-container {
    max-width: 450px;
    margin: 60px auto;
    background: white;
    border-radius: 1rem;
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    overflow: hidden;
}
.login-header {
    background: #0f172a;
    color: white;
    padding: 2rem;
    text-align: center;
}
.login-header h2 { margin: 0; font-size: 1.8rem; }
.login-header p { margin: 0.5rem 0 0 0; opacity: 0.8; }
.login-body { padding: 2rem; }
.login-form .form-group { margin-bottom: 1.5rem; }
.login-form input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    font-size: 1rem;
    box-sizing: border-box;
}
.login-form input:focus {
    outline: none;
    border-color: #f97316;
}
.login-form button {
    width: 100%;
    padding: 0.75rem;
    background: #f97316;
    color: white;
    border: none;
    border-radius: 0.75rem;
    font-weight: bold;
    font-size: 1rem;
    cursor: pointer;
}
.login-form button:hover { background: #ea580c; }
.login-footer { text-align: center; margin-top: 1.5rem; }
.login-footer a { color: #f97316; text-decoration: none; }
</style>

<div class="login-container">
    <div class="login-header">
        <h2>Welcome Back</h2>
        <p>Sign in to find the best deals</p>
    </div>
    <div class="login-body">
        <form method="POST" action="index.php?controller=auth&action=authenticate" class="login-form">
            <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
            
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="login-footer">
            <p>Don't have an account? <a href="index.php?controller=auth&action=register">Register here</a></p>
        </div>
    </div>
</div>

<?php require "../app/views/layouts/footer.php"; ?>