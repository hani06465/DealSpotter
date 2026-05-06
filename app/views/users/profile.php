<?php require "../app/views/layouts/header.php"; ?>

<h2>My Profile</h2>

<div class="card">
    <b>Name:</b> <?php echo htmlspecialchars($user['name']); ?><br>
    <b>Email:</b> <?php echo htmlspecialchars($user['email']); ?><br>
    <b>Joined:</b> <?php echo $user['created_at']; ?><br><br>

    <a class="btn btn-edit" href="index.php?controller=user&action=edit">Edit Profile</a>
</div>

<hr>

<!-- 👤 USER VIEW -->
<?php if($_SESSION['role'] != 'admin'): ?>

    <h3>My Deals</h3>

    <?php if($deals->num_rows == 0): ?>
        <p>You have not posted any deals yet.</p>
    <?php endif; ?>

    <?php while($deal = $deals->fetch_assoc()): ?>
        <div class="card">

            <img src="../uploads/<?php echo htmlspecialchars($deal['image']); ?>" width="150"><br><br>

            <b><?php echo htmlspecialchars($deal['item_name']); ?></b><br>
            Price: <?php echo htmlspecialchars($deal['price']); ?><br><br>

            <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $deal['user_id'] || $_SESSION['role'] == 'admin'): ?>
     
<a  class="btn-edit"  href="index.php?controller=deal&action=edit&id=<?php echo $deal['id']; ?>">Edit</a>
<a class="btn btn-delete"
   onclick="return confirm('Are you sure you want to delete this deal?')"
   href="index.php?controller=deal&action=delete&id=<?php echo $deal['id']; ?>">
   Delete
</a>
<br><br>
<?php endif; ?>

        </div>
    <?php endwhile; ?>

<?php endif; ?>

---

<!-- 👑 ADMIN VIEW -->
<?php if($_SESSION['role'] == 'admin'): ?>

    <h3>All Users</h3>

    <?php if($users->num_rows == 0): ?>
        <p>No users found.</p>
    <?php endif; ?>

    <?php while($u = $users->fetch_assoc()): ?>
        
        <div class="card">

            <b><?php echo htmlspecialchars($u['name']); ?></b><br>
            Email: <?php echo htmlspecialchars($u['email']); ?><br><br>

            <a class="btn btn-delete"
               onclick="return confirm('Delete this user?')"
               href="index.php?controller=user&action=deleteUser&id=<?php echo $u['id']; ?>">
               Delete
            </a>
        

        </div>

    <?php endwhile; ?>

<?php endif; ?>

<?php require "../app/views/layouts/footer.php"; ?>