<?php require "../app/views/layouts/header.php"; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .edit-container {
        max-width: 520px;
        margin: 50px auto;
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
        padding: 35px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"] {
        width: 100%;
        padding: 14px;
        margin-bottom: 18px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 15px;
        box-sizing: border-box;
    }

    form input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
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

    .password-section {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }
</style>

<div class="edit-container">
    <h2>Edit Profile</h2>

    <form method="POST" action="index.php?controller=user&action=update">
        
        <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">

        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" placeholder="Full Name" required>
        
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" placeholder="Email Address" required>

        <div class="password-section">
            <p><strong>For changing password, fill these:</strong></p>
            
            <input type="password" name="current_password" placeholder="Current Password">
            <input type="password" name="new_password" placeholder="New Password">
            <input type="password" name="confirm_password" placeholder="Confirm New Password">
        </div>

        <button type="submit">Update Profile</button>
    </form>
</div>

<?php require "../app/views/layouts/footer.php"; ?>