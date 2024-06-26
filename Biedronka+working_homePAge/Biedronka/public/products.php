<?php
//include product manager class
require_once '../src/ProductManager.php';

//create product manager instance
$productManager = new ProductManager();
//get products grouped by category
$groupedProducts = $productManager->getProductsGroupedByCategory();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../css/products.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

  <!-- Products display section -->
  <div class="products-container">
        <h1>Our Products</h1>
        <!-- Check if there are any grouped products to display -->
        <?php if (!empty($groupedProducts)): ?>
            <!-- go  over each category and its products -->
            <?php foreach ($groupedProducts as $category => $products): ?>
                <div class="category-container">
                    <!-- Display the category name -->
                    <h2 class="category-title"><?= htmlspecialchars(ucwords($category)) ?></h2>
                    <!-- go over each product in the current category -->
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <!-- Display product name, price, and description -->
                            <h3><?= htmlspecialchars($product->getName()) ?></h3>
                            <p>Price: €<?= htmlspecialchars(number_format($product->getPrice(), 2)) ?></p>
                            <p><?= nl2br(htmlspecialchars($product->getDescription())) ?></p>
                            <!-- Form for adding the product to the basket -->
                            <form action="add_to_basket.php" method="post">
                                <input type="hidden" name="product_id" value="<?= $product->getId() ?>">
                                <label for="quantity_<?= $product->getId() ?>">Quantity:</label>
                                <input type="number" id="quantity_<?= $product->getId() ?>" name="quantity" value="1" min="1" max="99">
                                <button type="submit" class="btn">Add to Basket</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Display a message if no products are found -->
            <p>No products found.</p>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
