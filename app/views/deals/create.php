<?php require "../app/views/layouts/header.php"; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: #eef1f5;
        min-height: 100vh;
    }

    .add-deal-container {
        max-width: 520px;
        margin: 40px auto;
        padding: 0 15px;
    }

    h2 {
        text-align: center;
        color: #1f2937;
        margin-bottom: 25px;
    }

    form {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    form input[type="text"],
    form input[type="file"],
    form button {
        width: 100%;
        padding: 14px;
        margin-bottom: 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 15px;
        box-sizing: border-box;
    }

    form input[type="text"]:focus,
    form input[type="file"]:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
        outline: none;
    }

    form button {
        background: #3b82f6;
        color: white;
        font-weight: bold;
        cursor: pointer;
        border: none;
        padding: 14px;
        font-size: 16px;
        transition: all 0.2s;
    }

    form button:hover {
        background: #2563eb;
        transform: translateY(-2px);
    }
</style>

<div class="add-deal-container">
    <h2>Add Deal</h2>
    
    <form method="POST" action="index.php?controller=deal&action=store" enctype="multipart/form-data">
        
        <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">

        <input type="text" name="item_name" placeholder="Item Name" required>
        <input type="text" name="price" placeholder="Price" required>
        <input type="text" name="store_name" placeholder="Store Name" required>
        <input type="text" name="phone" placeholder="Phone">
        <input type="text" name="location" placeholder="Location">
        
        <input type="file" name="image" accept="image/*">

        <button type="submit">Add Deal</button>
    </form>
</div>