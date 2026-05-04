<?php require "../app/views/layouts/header.php"; ?>
<h2>Add Deal</h2>

<form method="POST" action="index.php?controller=deal&action=store" enctype="multipart/form-data">

<input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">

<input type="text" name="item_name" placeholder="Item Name"><br><br>
<input type="text" name="price" placeholder="Price"><br><br>
<input type="text" name="store_name" placeholder="Store Name"><br><br>
<input type="text" name="phone" placeholder="Phone"><br><br>
<input type="text" name="location" placeholder="Location"><br><br>

<input type="file" name="image"><br><br>

<button>Add Deal</button>

</form>