<?php
include 'config.php';
include 'header.php';

// Get featured products (e.g. latest 4)
$stmt = $pdo->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 4");
$stmt->execute();
$featured = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
  
 <style>
  body {
    margin: 0;
    font-family: serif;
    background-color: #e6bcae; /* same as peachy background */
  }
  .container {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 50px;
    gap: 40px;
  }
  .images {
    display: flex;
    gap: 1px;
    align-items: center;
  }
  .images img {
    width: 140px;
    height: 200px;
    object-fit: cover;
    border: 6px solid white;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    border-radius: 15px;
    transform-origin: center;
  }
  /* specific transforms for different rotated and shaped images */
  .img1 {
    border-radius: 35% 35% 25% 25% / 40% 50% 20% 20%;
    transform: rotate(-9deg);
  }
  .img2 {
    border-radius: 45% 45% 15% 15% / 55% 55% 25% 25%;
    transform: rotate(-5deg);
  }
  .img3 {
    width: 100px;
    height: 160px;
    border-radius: 100px;
    border : 8px solid black;
    transform: rotate(0deg);
  }
  .img4 {
    border-radius: 35% 45% 30% 40% / 30% 60% 10% 50%;
    transform: rotate(5deg);
  }
  .img5 {
    border-radius: 50% 40% 60% 60% / 60% 40% 60% 60%;
    transform: rotate(10deg);
  }

  .text-content {
    max-width: 300px;
    color: #000;
    text-align: center;
  }
  .text-content h1 {
    font-weight: 600;
    font-size: 2.4rem;
    margin: 0 0 12px 0;
    line-height: 1.2;
  }
  .text-content p {
    font-size: 0.9rem;
    margin: 0 0 25px 0;
    font-weight: 300;
  }
  .btn-shop {
    background-color: black;
    color: white;
    font-weight: 700;
    font-size: 0.9rem;
    padding: 10px 25px;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-transform: none;
  }
  .btn-shop:hover {
    background-color: #333;
  }

  /* ---------------- Featured Products ---------------- */
  /* Featured Products Section */
  .featured-products {
    background-color: #5a3a26;
    padding: 40px 50px;
    margin-top: 40px;
    border-radius: 15px;
  }
  .featured-products h2 {
    color: white;
    font-weight: 600;
    font-size: 1.8rem;
    margin-bottom: 30px;
  }
  .featured-list {
    display: flex;
    gap: 30px;
    justify-content: center;
    flex-wrap: nowrap;
    overflow-x: auto;
    padding-bottom: 10px;
  }
  .featured-list::-webkit-scrollbar {
    display: none;
  }
  .featured-list {
    scrollbar-width: none;
  }
  .featured-list img {
    height: 280px;
    border-radius: 24px;
    border: 6px solid white;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.3s ease;
  }
  .featured-list img:hover {
    transform: scale(1.05);
  }


  /* ---------------- About Us ---------------- */
  .about-us {
    background-color: #e6bcae;
    padding: 50px 80px;
    text-align: left;
  }
  .about-us h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #3e1f15;
    margin-bottom: 25px;
    text-align: left;
  }
  .about-cards {
    display: flex;
    gap: 20px;
    justify-content: flex-start;
    flex-wrap: wrap;
  }
  .about-card {
    background-color: #5b352a;
    color: white;
    border-radius: 10px;
    padding: 20px;
    width: 30%;
    text-align: left;
  }

  .footer-text {
    text-align: center;
    padding: 30px;
    font-style: italic;
  }

  /* Responsive */
@media (max-width: 1000px) {
    .hero {
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .hero-text {
      max-width: 100%;
    }
    .hero-images img:nth-child(3) {
      height: 200px;
      border: 4px solid #422a19;
      transform: scale(1) !important;
    }
    .about-cards {
      flex-direction: column;
      gap: 25px;
    }
    .about-card {
      width: 100%;
    }
    .featured-products {
      padding: 30px 25px;
    }
    .featured-list {
      gap: 20px;
    }
  }
</style>
</head>
<body>

<div class="container">
  <div class="images">
    <img src="images/hero1.jpg" alt="image 1" class="img1" />
    <img src="images/hero2.jpg" alt="image 2" class="img2" />
    <img src="images/hero3.jpg" alt="image 3" class="img3" />
    <img src="images/hero4.jpg" alt="image 4" class="img4" />
    <img src="images/hero5.jpg" alt="image 5" class="img5" />
  </div>

  <div class="text-content">
    <h1>Fashion for<br>Everyone</h1>
    <p>Trendy Clothing items for men and woman</p>
    <a href="shop.php" style="display:inline-block; background:#000; color:#fff; padding:12px 30px; border-radius:25px; font-weight: 600; margin-top: 20px;">Shop Now</a>
  </div>
</div>

</body>

  <!-- Featured Products -->
  <section class="featured-products" aria-label="Featured Products">
    <h2>Featured Products</h2>
    <div class="featured-list">
      <?php foreach($featured as $prod): ?>
        <a href="product.php?id=<?= $prod['id'] ?>" class="product-card" aria-label="<?= htmlspecialchars($prod['name']) ?>">
          <img src="<?= htmlspecialchars($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>" />
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- About Us -->
  <section class="about-us" aria-label="About Us">
    <h2>About Us</h2>
    <div class="about-cards">
      <section class="about-card">
        <p>Welcome to Aavira, your one-stop destination for timeless style and self-care. At Aavira, we believe that fashion and beauty go hand in hand. Our goal is to bring you the finest collection of men’s and women’s clothing, premium watches, and quality skincare products—all curated with care to help you look and feel your best every day.</p>
      </section>
      <section class="about-card">
        <p>We started Aavira with a simple mission: to make shopping effortless, enjoyable, and inspiring. Whether you’re dressing for a special occasion, upgrading your daily essentials, or enhancing your skincare routine, we’ve got something special for you.</p>
      </section>
      <section class="about-card">
        <p>Every product at Aavira is chosen for its style, comfort, and quality—so you can shop with confidence knowing you’re getting the best. We’re passionate about helping our customers express themselves through fashion and self-care, with collections that keep up with modern trends and timeless elegance alike.</p>
      </section>
    </div>
  </section>

  <p class="footer-text" aria-live="polite">Join the Aavira family today—because you deserve to look good, feel confident, and shine every day.</p>
</main>

<?php include 'footer.php'; ?>
