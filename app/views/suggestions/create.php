<?php require "../app/views/layouts/header.php"; ?>

<h2>Contact Us / Suggestion</h2>

<form method="POST" action="index.php?controller=suggestion&action=store">

<textarea name="message" placeholder="Write your suggestion..." rows="5" style="width:100%;"></textarea><br><br>

<button>Send</button>

</form>

<?php require "../app/views/layouts/footer.php"; ?>