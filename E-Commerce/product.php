<?php
include 'config.php';
include 'header.php';

$id = $_GET['id'] ?? 0;
$id = (int)$id;

if (!$id) {
  header('Location: home.php');
  exit;
}

$stmt = $pdo->prepare("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id WHERE p.id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
  echo "<main><h2>Product not found.</h2></main>";
  include 'footer.php';
  exit;
}
?>

<main style="max-width: 900px; margin: 40px auto;">
  <h1 style="color: #4d2f1c;"><?= htmlspecialchars($product['name']) ?></h1>
  <div style="display: flex; gap: 30px; flex-wrap: wrap;">
    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="width: 300px; height: 400px; object-fit: cover; border-radius: 15px;" />
    <div style="flex: 1;">
      <p><strong>Category:</strong> <?= htmlspecialchars($product['category_name']) ?></p>
      <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($product['description'])) ?></p>
      <p><strong>Price:</strong> $<?= number_format($product['price'],2) ?></p>
      <p><strong>Size:</strong> <?= htmlspecialchars($product['size']) ?></p>
      <button style="padding: 10px 20px; background: #4d2f1c; color:white; border:none; border-radius: 25px; cursor:pointer;">Add to Cart</button>
    </div>
  </div>
  <a href="javascript:history.back()" style="display: inline-block; margin-top: 30px; color: #4d2f1c;">&larr; Back to category</a>
</main>

<?php include 'footer.php'; ?>
