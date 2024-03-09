<?php
require_once '../src/ProductManager.php';

$productManager = new ProductManager();
$groupedProducts = $productManager->getProductsGroupedByCategory();
session_start();
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}
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
<?php include 'navbar.php'; ?>
    <h1>Our Products</h1>
    <a href="view_basket.php">View Basket</a>
    <?php foreach ($groupedProducts as $category => $products): ?>
    <h2><?= htmlspecialchars(ucwords($category)) ?></h2> <!-- Capitalize the first letter of each word -->
    <div class="products-container">
    <?php foreach ($products as $product): ?>
    <div class="product">
        <h2><?= htmlspecialchars($product['name']) ?></h2>
        <p>Price: €<?= htmlspecialchars($product['price']) ?></p>
        <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
        <!-- Add to Basket Form -->
        <form action="add_to_basket.php" method="post">
            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
            <label for="quantity_<?= $product['product_id'] ?>">Quantity:</label>
            <input type="number" id="quantity_<?= $product['product_id'] ?>" name="quantity" value="1" min="1" max="99" style="width: 60px;">
            <button type="submit">Add to Basket</button>
        </form>
    </div>
<?php endforeach; ?>
    </div>
<?php endforeach; ?>
</body>
</html>
