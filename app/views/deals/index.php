<h2>All-Deals</h2>

<!-- Search -->
<form method="GET" action="index.php">
    <input type="hidden" name="controller" value="deal">
     <input type="hidden" name="action" value="index"> 
    <input type="text" name="search" placeholder="Search item...">
    <button>Search</button>
</form>
<br>

<?php if(isset($_SESSION['user_id'])): ?>
    <a href="index.php?controller=deal&action=create">Add Deal</a>
<?php endif; ?>
<hr>

<?php while($deal = $deals->fetch_assoc()): ?>

<div style="border:1px solid #ccc; margin:10px; padding:10px;">

<img src="../uploads/<?php echo htmlspecialchars($deal['image']); ?>" width="200"><br>

<b><?php echo htmlspecialchars($deal['item_name']); ?></b><br>
Price: <?php echo htmlspecialchars($deal['price']); ?><br>
Store: <?php echo htmlspecialchars($deal['store_name']); ?><br>
Phone: <?php echo htmlspecialchars($deal['store_phone']); ?><br>
Location: <?php echo htmlspecialchars($deal['location']); ?><br>
<b style="color: <?php echo ($deal['status'] == 'Unavailable') ? 'red' : 'green'; ?>">
        <?php echo htmlspecialchars($deal['status']); ?>
</b>
<br><br>

<?php if(isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $deal['user_id'] || $_SESSION['role'] == 'admin')): ?>

<a href="index.php?controller=deal&action=edit&id=<?php echo $deal['id']; ?>">Edit</a>
<a href="index.php?controller=deal&action=delete&id=<?php echo $deal['id']; ?>">Delete</a>
<br><br>

<!--Change Status -->
        <a href="index.php?controller=deal&action=changeStatus&id=<?php echo $deal['id']; ?>&status=available">
            Mark Available
        </a>|

        <a href="index.php?controller=deal&action=changeStatus&id=<?php echo $deal['id']; ?>&status=Unavailable">
            Mark Unavailable
        </a>

<?php endif; ?>

</div>

<?php endwhile; ?>