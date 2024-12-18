<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="profile">
            <img src="<?php echo base_url('assets/images/user.png'); ?>" alt="User Image">
            <h3>Tom Holland</h3>
        </div>
        <ul>
            <li class="active"><i class="fas fa-home"></i> Home</li>
            <li><i class="fas fa-bars"></i> Menu</li>
            <li><i class="fas fa-newspaper"></i> Articles</li>
            <li><i class="fas fa-cog"></i> Setting</li>
            <li>
                <a href="logout" style="color: red; text-decoration: none;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
        <div class="faster-delivery">
            <img src="<?php echo base_url('assets/images/delivery.png'); ?>" alt="Delivery">
            <p>Faster Delivery</p>
            <a href="#">Learn More</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h2>Welcome to Eatland 🍔</h2>
        </header>
        <div class="filter-section">
            <h3>All Item</h3>
            <div class="categories">
                <span>All</span>
                <span>Burger</span>
                <span>Pizza</span>
                <span>Mutton</span>
                <span>Chicken</span>
                <span>Fish</span>
            </div>
        </div>

        <!-- Item List -->
        <div class="item-list">
            <div class="item-card">
                <img src="<?php echo base_url('assets/images/fish.png'); ?>" alt="Fish Tomato">
                <h4>Fish Tomato</h4>
                <p>Lorem ipsum is the most popular dummy text.</p>
                <span>$39</span>
            </div>
            <div class="item-card">
                <img src="<?php echo base_url('assets/images/salmon.png'); ?>" alt="Salmon">
                <h4>Salmon</h4>
                <p>Lorem ipsum is the most popular dummy text.</p>
                <span>$56</span>
            </div>
            <div class="item-card">
                <img src="<?php echo base_url('assets/images/chicken.png'); ?>" alt="Chicken">
                <h4>Chicken</h4>
                <p>Lorem ipsum is the most popular dummy text.</p>
                <span>$64</span>
            </div>
        </div>
    </div>
</body>
</html>
