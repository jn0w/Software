<?php
require_once '../src/ProductManager.php';

$productManager = new ProductManager();
$products = $productManager->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Our Products</h1>
    <div class="products-container">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <p>Price: $<?= htmlspecialchars($product['price']) ?></p>
                <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                <!-- You can also add an image if your products table includes image URLs -->
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
