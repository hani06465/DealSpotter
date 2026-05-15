<?php require "../app/views/layouts/header.php"; ?>
<!-- <h2>All-Deals</h2> -->


<!-- <h2>All-Deals</h2> -->
<div style="margin: 40px 0;"></div>
<div style="margin: 40px 0;"></div>
<?php while($deal = $deals->fetch_assoc()): ?>

<div class="card">

    <!-- Full Width Image -->
    <img src="../uploads/<?php echo htmlspecialchars($deal['image']); ?>" 
         alt="<?php echo htmlspecialchars($deal['item_name']); ?>"
         style="width: 100%; height: 220px; object-fit: cover; border-radius: 10px 10px 0 0; display: block;">

    <div style="padding: 15px 15px 20px 15px;">
        
        <b><?php echo htmlspecialchars($deal['item_name']); ?></b><br><br>
        
        <strong>Price:</strong> <?php echo htmlspecialchars($deal['price']); ?><br>
        <strong>Store:</strong> <?php echo htmlspecialchars($deal['store_name']); ?><br>
        <strong>Phone:</strong> <?php echo htmlspecialchars($deal['store_phone']); ?><br>
        <strong>Location:</strong> <?php echo htmlspecialchars($deal['location']); ?><br><br>

        <strong>Status:</strong> 
        <?php if($deal['status'] == 'Unavailable'): ?>
            <span style="color:red; font-weight:bold;">Deal Ended</span>
        <?php else: ?>
            <span style="color:green; font-weight:bold;">Available</span>
        <?php endif; ?>

        <br><br>

        <?php if(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin'): ?>
            <a class="btn-edit" href="index.php?controller=deal&action=edit&id=<?php echo $deal['id']; ?>">Edit</a>
            <a class="btn btn-delete"
               onclick="return confirm('Are you sure you want to delete this deal?')"
               href="index.php?controller=deal&action=delete&id=<?php echo $deal['id']; ?>">
               Delete
            </a>
            <br><br>
        <?php endif; ?>

        <?php if(isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $deal['user_id'] || $_SESSION['role'] == 'admin')): ?>
            <a href="index.php?controller=deal&action=changeStatus&id=<?php echo $deal['id']; ?>&status=available">Mark Available</a> |
            <a href="index.php?controller=deal&action=changeStatus&id=<?php echo $deal['id']; ?>&status=Unavailable">Mark Unavailable</a>
            <br><br>
        <?php endif; ?>

        <a class="btn btn-status"
           href="index.php?controller=comment&action=show&deal_id=<?php echo $deal['id']; ?>">
           Comments
        </a>

    </div>
</div>
<?php endwhile; ?>
<?php require "../app/views/layouts/footer.php"; ?>