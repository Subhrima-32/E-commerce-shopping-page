<?php
include 'config.php';
include 'header.php';

// Example featured products images for static display
$featuredImages = [
    'images/featured1.jpg', // woman with watch
    'images/featured2.jpg', // skincare serum bottles
    'images/featured3.jpg', // man in brown hoodie
    'images/featured4.jpg'  // men's watch
];
?>

<main>
<style>
  body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #d8a999; /* light brownish-peach */
    color: #2c1b10;
  }
  main {
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Hero Section */
  .hero {
    background-color: #d8a999;
    padding: 50px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
  }
  .hero-images {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: nowrap;
  }
  .hero-images img {
    height: 180px;
    border-radius: 20px;
    object-fit: cover;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    border: 3px solid white;
    transition: transform 0.3s ease;
  }
  .hero-images img:nth-child(3) {
    border-radius: 100px;
    border: 6px solid #422a19;
    height: 220px;
    box-shadow: 0 7px 14px rgba(0,0,0,0.25);
    transform: scale(1.1);
    position: relative;
    z-index: 1;
  }
  .hero-images img:hover {
    transform: scale(1.15);
    z-index: 2;
  }
  .hero-text {
    max-width: 450px;
    font-weight: 600;
    text-align: left;
    color: #231608;
  }
  .hero-text h1 {
    font-size: 3rem;
    margin: 0 0 20px 0;
    font-weight: 700;
    line-height: 1.1;
  }
  .hero-text p {
    font-weight: 500;
    margin-bottom: 25px;
  }
  .btn-shop {
    background-color: #231608;
    color: white;
    padding: 12px 32px;
    font-size: 1.1rem;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    font-weight: 700;
    text-transform: none;
    transition: background-color 0.3s ease;
  }
  .btn-shop:hover {
    background-color: #5a3b1b;
  }

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

  /* About Us Section */
  .about-us {
    padding: 60px 40px 80px;
    background-color: #d8a999;
  }
  .about-us h2 {
    font-size: 2.4rem;
    font-weight: 700;
    margin-bottom: 40px;
    color: #3e1f15;
  }

  .about-cards {
    display: flex;
    gap: 30px;
    justify-content: space-between;
    flex-wrap: wrap;
  }
  .about-card {
    background-color: #5b352a;
    color: white;
    border-radius: 20px;
    padding: 28px 25px;
    width: 30%;
    font-size: 1rem;
    line-height: 1.5;
    box-sizing: border-box;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  }
  .about-card p {
    margin: 0;
  }

  /* Footer CTA Text */
  .footer-cta {
    text-align: center;
    font-weight: 600;
    font-size: 1rem;
    margin-top: 60px;
    color: #231608;
  }

  /* Social Links */
  .social-links {
    margin-top: 30px;
    display: flex;
    justify-content: center;
    gap: 20px;
  }
  .social-links a {
    color: #5a3a26;
    text-decoration: none;
    font-size: 1.6rem;
    transition: color 0.3s ease;
  }
  .social-links a:hover {
    color: #231608;
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



<section class="about-us" aria-label="About Us Section">
  <h2>About Us</h2>
  <div class="about-cards">
    <article class="about-card">
      <p>Welcome to Aavira, your one-stop destination for timeless style and self-care. At Aavira, we believe that fashion and beauty go hand in hand. Our goal is to bring you the finest collection of men’s and women’s clothing, premium watches, and quality skincare products—all curated with care to help you look and feel your best every day.</p>
    </article>
    <article class="about-card">
      <p>We started Avira with a simple mission: to make shopping effortless, enjoyable, and inspiring. Whether you’re dressing for a special occasion, upgrading your daily essentials, or enhancing your skincare routine, we’ve got something special for you.</p>
    </article>
    <article class="about-card">
      <p>Every product at Avira is chosen for its style, comfort, and quality—so you can shop with confidence knowing you’re getting the best. We’re passionate about helping our customers express themselves through fashion and self-care, with collections that keep up with modern trends and timeless elegance alike.</p>
    </article>
  </div>

  <p class="footer-cta">Join the Aavira family today—because you deserve to look good, feel confident, and shine every day.</p>

  <div class="social-links" aria-label="Social Media Links">
    <a href="#" aria-label="Email"><svg width="24" height="24" fill="currentColor"><!-- email icon svg --><circle cx="12" cy="12" r="10" stroke="none" fill="currentColor" /></svg></a>
    <a href="#"