<?php require "../app/views/layouts/header.php"; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .suggestion-container {
        max-width: 600px;
        margin: 60px auto;
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
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    textarea {
        width: 100%;
        padding: 16px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 16px;
        resize: vertical;
        min-height: 180px;
        font-family: inherit;
        box-sizing: border-box;
    }

    textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        outline: none;
    }

    button {
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
        margin-top: 10px;
    }

    button:hover {
        background: #2563eb;
        transform: translateY(-2px);
    }
</style>

<div class="suggestion-container">
    <h2>Write your Suggestion</h2>

    <form method="POST" action="index.php?controller=suggestion&action=store">
        
        <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">

        <textarea 
            name="message" 
            placeholder="Write your report or suggestion here..." 
            rows="8" 
            required></textarea>

        <button type="submit">Send Suggestion</button>
    </form>
</div>

<?php require "../app/views/layouts/footer.php"; ?>