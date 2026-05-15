<?php require "../app/views/layouts/header.php"; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
    }

    .profile-container {
        max-width: 900px;
        margin: 30px auto;
        padding: 0 15px;
    }

    h2 {
        text-align: center;
        color: #1f2937;
        margin-bottom: 25px;
        font-size: 28px;
    }

    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        padding: 25px;
        margin-bottom: 25px;
    }

    .profile-info {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: center;
    }

    .profile-info div {
        flex: 1;
        min-width: 280px;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        display: inline-block;
        transition: all 0.3s;
    }

    .btn-edit {
        background: #3b82f6;
        color: white;
    }

    .btn-edit:hover {
        background: #2563eb;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
        transform: translateY(-2px);
    }

    .deal-card {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        align-items: center;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        padding: 20px;
        margin-bottom: 20px;
    }

    .deal-card img {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border-radius: 10px;
    }

    .deal-info {
        flex: 1;
        min-width: 250px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    hr {
        border: none;
        height: 1px;
        background: #e5e7eb;
        margin: 35px 0;
    }

    h3 {
        color: #1f2937;
        margin: 30px 0 20px 0;
    }
</style>

<div class="profile-container">

    <h2><?php echo htmlspecialchars($user['name']); ?>'s Profile</h2>

    <div class="card">
        <div class="profile-info">
            <div>
                <strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?><br><br>
                <strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?><br><br>
                <strong>Joined:</strong> <?php echo $user['created_at']; ?>
            </div>
        </div>
        
        <a class="btn btn-edit" href="index.php?controller=user&action=edit">Edit Profile</a>
    </div>

    <hr>

    <!-- Regular User - My Deals -->
    <?php if($_SESSION['role'] != 'admin'): ?>

        <h3>My Deals</h3>

        <?php if($deals->num_rows == 0): ?>
            <div class="card">
                <p>You have not posted any deals yet.</p>
            </div>
        <?php endif; ?>

        <?php while($deal = $deals->fetch_assoc()): ?>
            <div class="deal-card">
                <img src="../uploads/<?php echo htmlspecialchars($deal['image']); ?>" alt="<?php echo htmlspecialchars($deal['item_name']); ?>">

                <div class="deal-info">
                    <h4><?php echo htmlspecialchars($deal['item_name']); ?></h4>
                    <p><strong>Price:</strong> <?php echo htmlspecialchars($deal['price']); ?></p>
                    <p><strong>Store:</strong> <?php echo htmlspecialchars($deal['store_name'] ?? 'N/A'); ?></p>
                    
                    <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $deal['user_id'] || $_SESSION['role'] == 'admin'): ?>
                        <div class="action-buttons">
                            <a class="btn btn-edit" href="index.php?controller=deal&action=edit&id=<?php echo $deal['id']; ?>">Edit</a>
                            <a class="btn btn-delete"
                               onclick="return confirm('Are you sure you want to delete this deal?')"
                               href="index.php?controller=deal&action=delete&id=<?php echo $deal['id']; ?>">
                               Delete
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>

    <?php endif; ?>

    <!-- Admin - All Users -->
    <?php if($_SESSION['role'] == 'admin'): ?>

        <h3>All Users</h3>

        <?php if($users->num_rows == 0): ?>
            <div class="card">
                <p>No users found.</p>
            </div>
        <?php endif; ?>

        <?php while($u = $users->fetch_assoc()): ?>
            <div class="card">
                <strong><?php echo htmlspecialchars($u['name']); ?></strong><br>
                Email: <?php echo htmlspecialchars($u['email']); ?><br><br>
                
                <a class="btn btn-delete"
                   onclick="return confirm('Delete this user?')"
                   href="index.php?controller=user&action=deleteUser&id=<?php echo $u['id']; ?>">
                   Delete User
                </a>
            </div>
        <?php endwhile; ?>

    <?php endif; ?>

</div>

<?php require "../app/views/layouts/footer.php"; ?>