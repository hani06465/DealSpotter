<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DealSpotter</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }
        header {
            background: #0f172a;
            padding: 15px 20px;
        }
        .header-container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .logo-area {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo-icon {
            background: #f97316;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 20px;
        }
        .logo-area h1 {
            color: white;
            font-size: 24px;
        }
        .logo-area h1 span {
            color: #f97316;
        }
        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
        }
        .mobile-post-btn {
            display: none;
            background: #f97316;
            color: white;
            padding: 10px 15px;
            border-radius: 30px;
            text-decoration: none;
        }
        .search-area {
            flex: 1;
            max-width: 400px;
            position: relative;
        }
        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
        .search-input {
            width: 100%;
            padding: 10px 10px 10px 35px;
            border-radius: 10px;
            border: none;
        }
        .desktop-post-btn {
            background: #f97316;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
        }
        @media (max-width: 768px) {
            .mobile-post-btn { display: block; }
            .desktop-post-btn { display: none; }
            .search-area { max-width: 100%; }
            .nav-links { display: none; }
        }
        main {
            max-width: 1280px;
            margin: 20px auto;
            padding: 0 15px;
        }
        .deals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .deal-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        .card-image {
            height: 200px;
            overflow: hidden;
        }
        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .card-content {
            padding: 15px;
        }
        .card-content h3 {
            margin-bottom: 10px;
            color: #0f172a;
        }
        .store-info {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .deal-price {
            font-size: 24px;
            font-weight: bold;
            color: #f97316;
        }
        .location-time {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 10px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
        }
        .status-available {
            background: #d1fae5;
            color: #065f46;
        }
        .filter-bar {
            background: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .categories-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .category-btn {
            padding: 8px 16px;
            border-radius: 30px;
            border: 1px solid #e2e8f0;
            background: white;
            cursor: pointer;
            text-decoration: none;
            color: #475569;
            display: inline-block;
        }
        .category-btn.active {
            background: #0f172a;
            color: white;
        }
        .login-register {
            display: flex;
            gap: 15px;
        }
        .login-register a {
            color: white;
            text-decoration: none;
        }
        .login-register a:hover {
            color: #f97316;
        }
    </style>
<script src="/DealSpotter/public/assets/script.js" defer></script>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo-area">
                <div class="logo-icon">🔥</div>
                <h1>Deal<span>Spotter</span></h1>
                <a href="index.php?controller=deal&action=create" class="mobile-post-btn">+</a>
            </div>
            <div class="search-area">
                <span class="search-icon">🔍</span>
                <form method="GET" action="index.php" style="width: 100%;">
                    <input type="hidden" name="controller" value="deal">
                    <input type="hidden" name="action" value="index">
                    <input type="text" name="search" placeholder="Search deals..." 
                           class="search-input" value="<?php echo $_GET['search'] ?? ''; ?>">
                </form>
            </div>
            <div class="nav-links">
                <a href="index.php?controller=deal&action=index">Home</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="index.php?controller=user&action=profile">Profile</a>
                    <a href="index.php?controller=auth&action=logout">Logout</a>
                <?php else: ?>
                    <a href="index.php?controller=auth&action=login">Login</a>
                    <a href="index.php?controller=auth&action=register">Register</a>
                <?php endif; ?>
            </div>
            <a href="index.php?controller=deal&action=create" class="desktop-post-btn">+ Post a Deal</a>
        </div>
    </header>
    <main>