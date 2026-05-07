<?php require "../app/views/layouts/header.php"; ?>
<h2>All-Deals</h2>

<?php if(isset($_SESSION['success'])): ?>
    <div style="background:lightgreen; padding:10px; margin-bottom:10px;">
        <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
        ?>
    </div>
<?php endif; ?>
<?php if(isset($_SESSION['INVALID'])): ?>
    <div style="background:red; padding:10px; margin-bottom:10px;">
        <?php 
            echo $_SESSION['INVALID']; 
            unset($_SESSION['INVALID']);
        ?>
    </div>
<?php endif; ?>


<!--  for Searching deals -->
<form method="GET" action="index.php">
    <input type="hidden" name="controller" value="deal">
     <input type="hidden" name="action" value="index"> 
    <input type="text" name="search" placeholder="Search item...">
    <button>Search</button>
</form>
<br>


<hr>
<?php
require_once "../app/models/Comment.php";
$commentModel = new Comment();
?>

<?php while($deal = $deals->fetch_assoc()): ?>

<div class="card">

<img src="../uploads/<?php echo htmlspecialchars($deal['image']); ?>" width="200"><br>

<b><?php echo htmlspecialchars($deal['item_name']); ?></b><br>
Price: <?php echo htmlspecialchars($deal['price']); ?><br>
Store: <?php echo htmlspecialchars($deal['store_name']); ?><br>
Phone: <?php echo htmlspecialchars($deal['store_phone']); ?><br>
Location: <?php echo htmlspecialchars($deal['location']); ?><br>

    Status:
    <?php if($deal['status'] == 'Unavailable'): ?>
        <span style="color:red; font-weight:bold;">Deal Ended</span>
    <?php else: ?>
        <span style="color:green; font-weight:bold;">Available</span>
    <?php endif; ?>

    <br><br>

<?php if(isset($_SESSION['user_id']) &&  $_SESSION['role'] == 'admin'): ?>
     
<a  class="btn-edit"  href="index.php?controller=deal&action=edit&id=<?php echo $deal['id']; ?>">Edit</a>
<a class="btn btn-delete"
   onclick="return confirm('Are you sure you want to delete this deal?')"
   href="index.php?controller=deal&action=delete&id=<?php echo $deal['id']; ?>">
   Delete
</a>
<br><br>
<?php endif; ?>

<?php if(isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $deal['user_id'] || $_SESSION['role'] == 'admin')): ?>
     
<!-- for changing Status -->
        <a href="index.php?controller=deal&action=changeStatus&id=<?php echo $deal['id']; ?>&status=available">
            Mark Available
        </a>|

        <a href="index.php?controller=deal&action=changeStatus&id=<?php echo $deal['id']; ?>&status=Unavailable">
            Mark Unavailable
        </a>
<?php endif; ?>
<br><br>

<!-- for comment section in each deal: -->
<?php if(isset($_SESSION['user_id'])): ?>

<form method="POST"
action="index.php?controller=comment&action=store">

    <input type="hidden"
    name="deal_id"
    value="<?php echo $deal['id']; ?>">

    <textarea name="comment"
    placeholder="Write comment..."
    required></textarea>

    <br><br>

    <button>Comment</button>

</form>

<?php endif; ?>

<!-- for displaying comments -->
<?php
$comments = $commentModel->getByDeal($deal['id']);
?>

<h4>Comments</h4>

<?php while($comment = $comments->fetch_assoc()): ?>

<div style="
background:#f1f1f1;
padding:10px;
margin-top:10px;
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

</div>

<?php endwhile; ?>



</div>

<?php endwhile; ?>
<?php require "../app/views/layouts/footer.php"; ?>