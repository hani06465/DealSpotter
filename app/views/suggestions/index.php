<?php require "../app/views/layouts/header.php"; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
    }

    .suggestions-container {
        max-width: 900px;
        margin: 30px auto;
        padding: 0 15px;
    }

    h2 {
        text-align: center;
        color: #1f2937;
        margin-bottom: 35px;
        font-size: 28px;
    }

    .suggestion-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        padding: 25px;
        margin-bottom: 20px;
        width: 100%;
    }

    .suggestion-card h4 {
        margin: 0 0 15px 0;
        color: #1f2937;
    }

    .suggestion-card p {
        margin: 0 0 15px 0;
        line-height: 1.6;
        color: #374151;
    }

    .suggestion-card small {
        color: #6b7280;
        font-size: 14px;
    }
</style>

<div class="suggestions-container">
    <h2>User Suggestions</h2>

    <?php if($suggestions->num_rows == 0): ?>
        <div class="suggestion-card">
            <p>No suggestions found.</p>
        </div>
    <?php endif; ?>

    <?php while($s = $suggestions->fetch_assoc()): ?>
        <div class="suggestion-card">
            <h4><?php echo htmlspecialchars($s['name']); ?></h4>
            <p><?php echo nl2br(htmlspecialchars($s['message'])); ?></p>
            <small><?php echo $s['created_at']; ?></small>
        </div>
    <?php endwhile; ?>
</div>

<?php require "../app/views/layouts/footer.php"; ?>