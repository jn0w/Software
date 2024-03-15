<?php
require_once '../src/ProductManager.php';

$productManager = new ProductManager();
$groupedProducts = $productManager->getProductsGroupedByCategory();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="style.css">
    
    <style>
        
        .category-container {
            margin-bottom: 30px;
        }
        .category-title {
            margin-top: 20px;
            margin-bottom: 10px;
            color: #007bff;
            font-size: 24px;
            text-align: left;
        }
        .product-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 4px;
            margin: 10px;
            display: inline-block;
            vertical-align: top;
            width: calc(33% - 20px);
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .product-card h3 {
            color: #007bff;
        }
        .product-card p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="products-container">
        <h1>Our Products</h1>
        <?php if (!empty($groupedProducts)): ?>
            <?php foreach ($groupedProducts as $category => $products): ?>
                <div class="category-container">
                    <h2 class="category-title"><?= htmlspecialchars(ucwords($category)) ?></h2>
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <h3><?= htmlspecialchars($product->getName()) ?></h3>
                            <p>Price: €<?= htmlspecialchars(number_format($product->getPrice(), 2)) ?></p>
                            <p><?= nl2br(htmlspecialchars($product->getDescription())) ?></p>
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
            <p>No products found.</p>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
