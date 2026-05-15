<?php require "../app/views/layouts/header.php"; ?>

<style>
.register-container {
    max-width: 500px;
    margin: 50px auto;
    background: white;
    border-radius: 1rem;
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    overflow: hidden;
}
.register-header {
    background: #0f172a;
    color: white;
    padding: 2rem;
    text-align: center;
}
.register-header h2 { margin: 0; font-size: 1.8rem; }
.register-header p { margin: 0.5rem 0 0 0; opacity: 0.8; }
.register-body { padding: 2rem; }
.register-form .form-group { margin-bottom: 1.5rem; }
.register-form input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    font-size: 1rem;
    box-sizing: border-box;
}
.register-form input:focus {
    outline: none;
    border-color: #f97316;
}
.register-form button {
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
.register-form button:hover { background: #ea580c; }
.register-footer { text-align: center; margin-top: 1.5rem; }
.register-footer a { color: #f97316; text-decoration: none; }
</style>

<div class="register-container">
    <div class="register-header">
        <h2>Create Account</h2>
        <p>Join DealSpotter to share and find deals</p>
    </div>
    <div class="register-body">
        <form method="POST" action="index.php?controller=auth&action=store" class="register-form">
            <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
            
            <div class="form-group">
                <input type="text" name="name" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="register-footer">
            <p>Already have an account? <a href="index.php?controller=auth&action=login">Login here</a></p>
        </div>
    </div>
</div>

<?php require "../app/views/layouts/footer.php"; ?>