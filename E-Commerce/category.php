<?php
include 'config.php';
include 'header.php';

$slug = $_GET['id'] ?? '';

if (!$slug) {
    header('Location: home.php');
    exit;
}

// Fetch category info
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$slug]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    echo "<main><h2>Category not found.</h2></main>";
    include 'footer.php';
    exit;
}

// Fetch products in this category
$prod_stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ?");
$prod_stmt->execute([$category['id']]);
$products = $prod_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
  <h1 style="color: #4d2f1c; max-width: 1200px; margin: 0 auto 20px;">
    <?= htmlspecialchars($category['name']) ?>
  </h1>

  <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 30px; justify-content: center;">
    <?php if (count($products) == 0): ?>
      <p>No products available in this category.</p>
    <?php else: ?>
      <?php foreach ($products as $prod): ?>
        <a href="product.php?id=<?= $prod['id'] ?>" 
           style="width: 180px; text-align: center; color: #4d2f1c; text-decoration: none;">
          <div style="border: 3px solid #4d2f1c; border-radius: 20px; overflow: hidden; background: white; height: 270px;">
            <img 
              src="<?= htmlspecialchars($prod['image']) ?>" 
              alt="<?= htmlspecialchars($prod['name']) ?>" 
              style="width: 100%; height: 100%; object-fit: cover;" 
              onerror="this.src='images/no-image.png';" />
          </div>
          <h3 style="margin-top: 10px; font-weight: 600; font-size: 16px;">
            <?= htmlspecialchars($prod['name']) ?>
          </h3>
          <p style="font-weight: 700;">$<?= number_format($prod['price'], 2) ?></p>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</main>

<?php include 'footer.php'; ?>
