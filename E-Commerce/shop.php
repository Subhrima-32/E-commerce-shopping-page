<?php
include 'config.php';
include 'header.php';

$q = $_GET['q'] ?? '';

// Basic product search
if ($q) {
    $query = "%$q%";
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? ORDER BY id DESC");
    $stmt->execute([$query]);
} else {
    // Show all products
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
}
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main style="max-width: 1200px; margin: 40px auto;">
  <h1>Shop</h1>
  <?php if ($q): ?>
    <p>Search results for <strong><?= htmlspecialchars($q) ?></strong>:</p>
  <?php endif; ?>

  <div style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center;">
    <?php if (count($products) === 0): ?>
      <p>No products found.</p>
    <?php else: ?>
      <?php foreach($products as $prod): ?>
        <a href="product.php?id=<?= $prod['id'] ?>" style="width: 180px; text-align: center; color: #4d2f1c; text-decoration: none;">
          <div style="border: 3px solid #4d2f1c; border-radius: 20px; overflow: hidden; background: white; height: 270px;">
            <img src="<?= htmlspecialchars($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>" style="width: 100%; height: 100%; object-fit: cover;" />
          </div>
          <h3 style="margin-top: 10px; font-weight: 600; font-size: 16px;"><?= htmlspecialchars($prod['name']) ?></h3>
          <p style="font-weight: 700;">$<?= number_format($prod['price'], 2) ?></p>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</main>

<?php include 'footer.php'; ?>
