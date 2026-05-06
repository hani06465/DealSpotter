<?php require "../app/views/layouts/header.php"; ?>

<h2>User Suggestions</h2>

<?php while($s = $suggestions->fetch_assoc()): ?>

<div class="card">

    <b><?php echo htmlspecialchars($s['name']); ?></b><br><br>

    <?php echo nl2br(htmlspecialchars($s['message'])); ?><br><br>

    <small><?php echo $s['created_at']; ?></small>

</div>

<?php endwhile; ?>

<?php require "../app/views/layouts/footer.php"; ?>