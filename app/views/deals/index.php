<?php require "../app/views/layouts/header.php"; ?>

<!-- Filter Bar -->
<div class="filter-bar">
    <div class="categories-wrapper">
        <div class="categories-container">
            <a href="index.php?controller=deal&action=index" class="category-btn <?php echo !isset($_GET['category']) ? 'active' : ''; ?>">All</a>
            <a href="index.php?controller=deal&action=index&category=Electronics" class="category-btn <?php echo ($_GET['category'] ?? '') == 'Electronics' ? 'active' : ''; ?>">Electronics</a>
            <a href="index.php?controller=deal&action=index&category=Fashion" class="category-btn <?php echo ($_GET['category'] ?? '') == 'Fashion' ? 'active' : ''; ?>">Fashion</a>
            <a href="index.php?controller=deal&action=index&category=Groceries" class="category-btn <?php echo ($_GET['category'] ?? '') == 'Groceries' ? 'active' : ''; ?>">Groceries</a>
            <a href="index.php?controller=deal&action=index&category=Home" class="category-btn <?php echo ($_GET['category'] ?? '') == 'Home' ? 'active' : ''; ?>">Home</a>
            <a href="index.php?controller=deal&action=index&category=Sports" class="category-btn <?php echo ($_GET['category'] ?? '') == 'Sports' ? 'active' : ''; ?>">Sports</a>
        </div>
    </div>
</div>

<!-- Deals Grid -->
<div class="deals-grid">
    <?php if($deals->num_rows == 0): ?>
        <div class="empty-state">
            <div class="empty-icon">🔍</div>
            <h3>No deals found</h3>
            <p>Try a different search or be the first to post a deal!</p>
        </div>
    <?php endif; ?>

    <?php while($deal = $deals->fetch_assoc()): ?>
        <div class="deal-card">
            <div class="card-image">
                <img src="../uploads/<?php echo htmlspecialchars($deal['image']); ?>" 
                     alt="<?php echo htmlspecialchars($deal['item_name']); ?>">
                
                <?php if($deal['status'] == 'available'): ?>
                    <div class="status-badge status-available">✓ Available</div>
                <?php elseif($deal['status'] == 'Unavailable'): ?>
                    <div class="status-badge status-gone">✗ Gone</div>
                <?php else: ?>
                    <div class="status-badge status-going">⏰ Going Fast</div>
                <?php endif; ?>
                
                <div class="discount-badge">DEAL</div>
            </div>
            
            <div class="card-content">
                <h3><?php echo htmlspecialchars($deal['item_name']); ?></h3>
                <div class="store-info">🏪 <?php echo htmlspecialchars($deal['store_name']); ?></div>
                
                <div class="price-section">
                    <div>
                        <div class="deal-price">$<?php echo number_format($deal['price'], 2); ?></div>
                    </div>
                    <div class="location-time">
                        <div>📍 <?php echo htmlspecialchars($deal['location']); ?></div>
                        <div>🕒 <?php echo date('M d, g:i a', strtotime($deal['created_at'])); ?></div>
                    </div>
                </div>
                
                <!-- COMMENT BUTTON - Added here -->
                <div style="margin-top: 15px;">
                    <a href="index.php?controller=comment&action=show&deal_id=<?php echo $deal['id']; ?>" 
                       style="display: inline-block; background: #10b981; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: bold;">
                        💬 View Comments
                    </a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php require "../app/views/layouts/footer.php"; ?>