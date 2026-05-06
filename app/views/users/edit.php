<?php require "../app/views/layouts/header.php"; ?>

<h2>Edit Profile</h2>

<form method="POST" action="index.php?controller=user&action=update">

<input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>"><br><br>

<input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br>
<h3> for changing password fill these </h3> 
<input type="password" name="current_password" placeholder="Current Password"><br><br>

<input type="password" name="new_password" placeholder="New Password"><br><br>

<input type="password" name="confirm_password" placeholder="Confirm New Password"><br><br>


<button>Update</button>

</form>

<?php require "../app/views/layouts/footer.php"; ?>