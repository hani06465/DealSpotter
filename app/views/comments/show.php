<?php require "../app/views/layouts/header.php"; ?>

<h2>Deal Details</h2>

<div class="card">

    <img src="../uploads/<?php echo htmlspecialchars($deal['image']); ?>"
    width="250">

    <br><br>

    <b>
        <?php echo htmlspecialchars($deal['item_name']); ?>
    </b>

    <br><br>

    Price:
    <?php echo htmlspecialchars($deal['price']); ?>

    <br><br>

    Store:
    <?php echo htmlspecialchars($deal['store_name']); ?>

    <br><br>

    Location:
    <?php echo htmlspecialchars($deal['location']); ?>

    <br><br>

    Status:
    <?php echo htmlspecialchars($deal['status']); ?>

</div>

<hr>

<h3>Comments</h3>

<!-- COMMENTS LOOP -->
<?php while($comment = $comments->fetch_assoc()): ?>

<div style="
background:#f5f5f5;
padding:10px;
margin-bottom:10px;
border-radius:5px;
">

    <b>
        <?php echo htmlspecialchars($comment['name']); ?>
    </b>

    <br><br>

    <?php echo nl2br(htmlspecialchars($comment['comment'])); ?>

    <br><br>

    <small>
        <?php echo $comment['created_at']; ?>
    </small>

    <br><br>
    </div>

<?php endwhile; ?>

<hr>
<!-- COMMENT FORM -->
<?php if(isset($_SESSION['user_id'])): ?>

<h3>Write Comment</h3>

<form method="POST"
action="index.php?controller=comment&action=store">

    <input type="hidden"
    name="deal_id"
    value="<?php echo $deal['id']; ?>">

    <textarea
    name="comment"
    rows="5"
    style="width:100%;"
    placeholder="Write your comment..."
    required></textarea>

    <br><br>

    <button>Comment</button>

</form>
<?php else: ?>

<p>
    Login to write comments.
</p>

<?php endif; ?>

<?php require "../app/views/layouts/footer.php"; ?>