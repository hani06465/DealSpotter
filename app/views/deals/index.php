<h2>All-Deals</h2>

<a href="index.php?controller=deal&action=create">Add Deal</a>

<?php while($deal = $deals->fetch_assoc()): ?>

<div style="border:1px solid #ccc; margin:10px; padding:10px;">

<img src="../uploads/<?php echo htmlspecialchars($deal['image']); ?>" width="200"><br>

<b><?php echo htmlspecialchars($deal['item_name']); ?></b><br>
Price: <?php echo htmlspecialchars($deal['price']); ?><br>
Store: <?php echo htmlspecialchars($deal['store_name']); ?><br>
Phone: <?php echo htmlspecialchars($deal['store_phone']); ?><br>
Location: <?php echo htmlspecialchars($deal['location']); ?><br>

<?php if(isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $deal['user_id'] || $_SESSION['role'] == 'admin')): ?>

<a href="index.php?controller=deal&action=edit&id=<?php echo $deal['id']; ?>">Edit</a>
<a href="index.php?controller=deal&action=delete&id=<?php echo $deal['id']; ?>">Delete</a>

<?php endif; ?>

</div>

<?php endwhile; ?>