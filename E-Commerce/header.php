<?php
// Load categories for sidebar
include_once 'config.php';

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Aavira - Online Store</title>
<style>
  /* Reset and basic layout */
  * {
    box-sizing: border-box;
  }
  body {
    margin:0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #e2b8a2;
    color: #4d2f1c;
  }
  a {
    text-decoration: none;
    color: inherit;
  }

  /* Sidebar styles */
  .sidebar {
    height: 100vh; width: 250px; position: fixed; z-index: 1000;
    top: 0; left: 0; background: #4d2f1c; color: white; padding-top: 60px;
    overflow-y: auto; transition: 0.3s;
  }
  .sidebar.closed {
    width: 0;
    padding-top: 0;
    overflow: hidden;
  }
  .sidebar ul {
    list-style-type: none; padding-left: 0;
  }
  .sidebar ul li {
    padding: 15px 30px; border-bottom: 1px solid #603d2e;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  .sidebar ul li:hover {
    background-color: #3e2414;
  }

  /* Hamburger menu */
  .menu-btn {
    position: fixed; top: 18px; left: 20px; font-size: 24px;
    cursor: pointer; color: #eeebe9ff; z-index: 1100;
    user-select: none;
  }

  /* Top navigation bar */
  .topnav {
    width: 100%; height: 60px; background: transparent;
    display: flex; align-items: center; justify-content: flex-start;
    padding: 0 80px 0 70px;
    position: fixed; top: 0; left: 0; z-index: 999;
  }
  .topnav img.logo {
    height: 35px;
    margin-right: 20px;
  }
  .topnav .nav-links {
    display: flex; gap: 40px; font-weight: 500;
    font-size: 16px;
  }
  .topnav .nav-links a {
    color: #4d2f1c;
    padding: 8px 5px;
    transition: color 0.3s ease;
  }
  .topnav .nav-links a:hover {
    color: #000;
  }

  /* Search bar */
  .topnav .search-box {
    margin-left: auto;
    margin-right: 20px;
    position: relative;
  }
  .topnav .search-box input {
    padding: 8px 40px 8px 15px;
    border-radius: 20px;
    border: none;
    background: #d8b2a3;
    color: #4d2f1c;
    font-size: 14px;
    outline: none;
  }
  .topnav .search-box button {
    position: absolute;
    right: 8px; top: 50%;
    transform: translateY(-50%);
    background: none; border: none;
    font-size: 16px;
    cursor: pointer;
    color: #4d2f1c;
  }

  /* Icons on right */
  .topnav .icons {
    display: flex; align-items: center; gap: 20px;
    font-size: 20px; color: #4d2f1c;
    cursor: pointer;
  }

  /* Main content spacing */
  main {
    margin-left: 250px;
    padding: 80px 40px 40px 40px;
    transition: margin-left 0.3s ease;
  }
  main.expanded {
    margin-left: 0;
  }

  /* Featured products styling */
  .featured-products {
    background: #6f4939;
    padding: 40px 10px;
    color: white;
  }
  .featured-products .products {
    display: flex; justify-content: center; gap: 20px;
    flex-wrap: nowrap; overflow-x: auto;
    scrollbar-width: none; -ms-overflow-style: none;
  }
  .featured-products .products::-webkit-scrollbar {
    display: none;
  }
  .featured-products .product-card {
    flex: 0 0 auto;
    border: 4px solid white; border-radius: 20px;
    overflow: hidden;
    background: white;
    width: 180px;
    height: 270px;
    position: relative;
  }
  .featured-products .product-card img {
    width: 100%; height: 100%; object-fit: cover;
  }

  /* About Us section */
  .about-us {
    background: #e2b8a2;
    padding: 40px 20px;
    max-width: 1200px;
    margin: 40px auto 80px;
  }
  .about-us h2 {
    font-family: 'Georgia', serif;
    font-weight: 900;
    font-size: 28px;
    margin-bottom: 30px;
  }
  .about-cards {
    display: flex; flex-wrap: wrap; gap: 20px;
  }
  .about-card {
    background: #6f4939;
    color: white;
    border-radius: 15px;
    padding: 20px;
    flex: 1 1 30%;
    min-width: 250px;
    font-size: 14px;
    line-height: 1.5;
  }
  .footer-text {
    text-align: center;
    font-style: italic;
    font-weight: 600;
    font-size: 15px;
    color: #4d2f1c;
    max-width: 1200px;
    margin: 0 auto 40px;
  }

  /* Responsive adjustments */
  @media (max-width: 980px) {
    .sidebar {
      width: 0;
      padding-top: 0;
      overflow: hidden;
    }
    main {
      margin-left: 0;
    }
  }
</style>
</head>
<body>

<div class="menu-btn" id="menu-btn">&#9776;</div>

<div class="sidebar closed" id="sidebar">
  <ul>
    <?php foreach($categories as $cat): ?>
      <?php if ($cat['id'] == 1): ?>
        <li><a href="watch.php" style="color:inherit; display:block;">Watch</a></li>
      <?php elseif ($cat['id'] == 2): ?>
        <li><a href="woman.php" style="color:inherit; display:block;">Woman</a></li>
      <?php elseif ($cat['id'] == 3): ?>
        <li><a href="men.php" style="color:inherit; display:block;">Men</a></li>
      <?php elseif ($cat['id'] == 4): ?>
        <li><a href="skincare.php" style="color:inherit; display:block;">Skincare</a></li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
</div>

<nav class="topnav">
  <img src="Aavira.png" alt="Aavira Logo" class="logo" /> <br></br>
  <h3>Aavira</h3>

  <div class="nav-links">
    <a href="home.php">Home</a>
    <a href="shop.php">Shop</a>
    <a href="about.php">About</a>
  </div>
  <form method="GET" action="shop.php" class="search-box" role="search" aria-label="Search Products">
    <input name="q" type="search" placeholder="Search Products" aria-label="Search Products" />
    <button type="submit">&#128269;</button> 
  </form>
  <div class="icons" aria-label="User icons">
    <span title="Favorites" role="img" aria-label="Favorites">&#10084;</span>
    <span title="Cart" role="img" aria-label="Shopping Cart">&#128722;</span>
    <span title="User Account" role="img" aria-label="User icon">&#128100;</span>
  </div>
</nav>

<script>
  // Toggle sidebar visibility
  const menuBtn = document.getElementById('menu-btn');
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.querySelector('main');

  menuBtn.addEventListener('click', () => {
    sidebar.classList.toggle('closed');
    if(sidebar.classList.contains('closed')){
      if(mainContent) mainContent.classList.add('expanded');
    } else {
      if(mainContent) mainContent.classList.remove('expanded');
    }
  });
</script>
