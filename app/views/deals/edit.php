<h2>Edit Deal</h2>

<form method="POST" action="index.php?controller=deal&action=update">

<input type="hidden" name="id" value="<?php echo $deal['id']; ?>">

<input type="text" name="item_name" value="<?php echo htmlspecialchars($deal['item_name']); ?>"><br><br>
<input type="text" name="price" value="<?php echo htmlspecialchars($deal['price']); ?>"><br><br>
<input type="text" name="store_name" value="<?php echo htmlspecialchars($deal['store_name']); ?>"><br><br>
<input type="text" name="phone" value="<?php echo htmlspecialchars($deal['store_phone']); ?>"><br><br>
<input type="text" name="location" value="<?php echo htmlspecialchars($deal['location']); ?>"><br><br>

<button>Update</button>

</form>