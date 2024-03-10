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
    <h2><?= htmlspecialchars(ucwords($category)) ?></h2>
    <div class="products-container">
    <?php foreach ($products as $product): ?>
    <div class="product">
        <!-- Use getter methods to access product properties -->
        <h2><?= htmlspecialchars($product->getName()) ?></h2>
        <p>Price: €<?= htmlspecialchars($product->getPrice()) ?></p>
        <p><?= nl2br(htmlspecialchars($product->getDescription())) ?></p>
        <!-- Add to Basket Form -->
        <form action="add_to_basket.php" method="post">
            <input type="hidden" name="product_id" value="<?= $product->getId() ?>">
            <label for="quantity_<?= $product->getId() ?>">Quantity:</label>
            <input type="number" id="quantity_<?= $product->getId() ?>" name="quantity" value="1" min="1" max="99" style="width: 60px;">
            <button type="submit">Add to Basket</button>
        </form>
    </div>
    <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</body>
</html>
