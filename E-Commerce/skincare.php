<?php
include 'config.php';
include 'header.php';

$category_id = 4; // Skincare category
$stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ?");
$stmt->execute([$category_id]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main style="max-width: 1000px; margin: 40px auto;">
  <h1 style="color: #4d2f1c;">Skincare Collection</h1>
  <div style="display: flex; flex-wrap: wrap; gap: 25px; margin-top: 20px;">
    <?php if ($products): ?>
      <?php foreach ($products as $product): ?>
        <div style="border:1px solid #ddd; border-radius:15px; width:220px; text-align:center; padding:15px;">
          <a href="product.php?id=<?= $product['id'] ?>" style="text-decoration:none; color:inherit;">
            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="width:200px; height:250px; object-fit:cover; border-radius:10px;">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <p><strong>$<?= number_format($product['price'], 2) ?></strong></p>
          </a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No products found in this category.</p>
    <?php endif; ?>
  </div>
</main>

<?php include 'footer.php'; ?>
