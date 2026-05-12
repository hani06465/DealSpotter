<?php require "../app/views/layouts/header.php"; ?>

<style>
    .deal-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 0 15px;
    }

    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .deal-image {
        width: 100%;
        height: 280px;
        object-fit: cover;
    }

    .deal-info {
        padding: 25px;
    }

    .deal-info h2 {
        margin: 0 0 20px 0;
        color: #1f2937;
    }

    .info-row {
        margin-bottom: 12px;
        font-size: 16px;
    }

    .info-label {
        font-weight: bold;
        color: #374151;
        display: inline-block;
        width: 100px;
    }

    .comment-card {
        background: #f8fafc;
        padding: 18px;
        border-radius: 10px;
        margin-bottom: 18px;
        border-left: 4px solid #3b82f6;
    }

    .comment-card b {
        color: #1f2937;
    }

    textarea {
        width: 100%;
        padding: 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 16px;
        resize: vertical;
        min-height: 120px;
    }

    button {
        background: #3b82f6;
        color: white;
        padding: 12px 28px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background: #2563eb;
    }
</style>

<div class="deal-container">

    <h2 style="text-align:center; margin-bottom:25px;">Deal Details</h2>

    <div class="card">
        <img src="../uploads/<?php echo htmlspecialchars($deal['image']); ?>" 
             alt="<?php echo htmlspecialchars($deal['item_name']); ?>"
             class="deal-image">

        <div class="deal-info">
            <h2><?php echo htmlspecialchars($deal['item_name']); ?></h2>

            <div class="info-row">
                <span class="info-label">Price:</span>
                <?php echo htmlspecialchars($deal['price']); ?>
            </div>
            <div class="info-row">
                <span class="info-label">Store:</span>
                <?php echo htmlspecialchars($deal['store_name']); ?>
            </div>
            <div class="info-row">
                <span class="info-label">Location:</span>
                <?php echo htmlspecialchars($deal['location']); ?>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <strong style="color: <?php echo $deal['status'] == 'Unavailable' ? 'red' : 'green'; ?>;">
                    <?php echo htmlspecialchars($deal['status']); ?>
                </strong>
            </div>
        </div>
    </div>

    <h3>Comments</h3>

    <?php if($comments->num_rows == 0): ?>
        <p>No comments yet. Be the first to comment!</p>
    <?php endif; ?>

    <?php while($comment = $comments->fetch_assoc()): ?>
        <div class="comment-card">
            <b><?php echo htmlspecialchars($comment['name']); ?></b><br><br>
            <?php echo nl2br(htmlspecialchars($comment['comment'])); ?><br><br>
            <small><?php echo $comment['created_at']; ?></small>
        </div>
    <?php endwhile; ?>

    <hr style="margin: 40px 0;">

    <h3>Write a Comment</h3>

    <?php if(isset($_SESSION['user_id'])): ?>
        <form method="POST" action="index.php?controller=comment&action=store">
            <input type="hidden" name="deal_id" value="<?php echo $deal['id']; ?>">

            <textarea name="comment" placeholder="Write your comment here..." required></textarea><br><br>
            
            <button type="submit">Post Comment</button>
        </form>
    <?php else: ?>
        <p>Please <a href="index.php?controller=auth&action=login">login</a> to write a comment.</p>
    <?php endif; ?>

</div>

<?php require "../app/views/layouts/footer.php"; ?>