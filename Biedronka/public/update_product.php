<?php
require_once '../src/Database.php';
require_once '../src/ProductManager.php';

$product_id = $_GET['product_id'] ?? null;
if (!$product_id) {
    // Redirect or handle error if product_id is missing
    echo "Product ID is missing.";
    exit;
}

$db = Database::getInstance()->getConnection();
$productManager = new ProductManager($db);
$product = $productManager->getProductById($product_id);

if (!$product) {
    // Redirect or handle error if product not found
    echo "Product not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Update Product</h1>
    <form method="post" action="update_product_handler.php">
        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">

        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" value="<?= $product['name'] ?>" required>

        <label for="category">Category ID:</label>
        <input type="text" name="category_id" id="category" value="<?= $product['category_id'] ?>" required>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="<?= $product['price'] ?>" step="0.01" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?= $product['description'] ?></textarea>

        <input type="submit" value="Update Product">
    </form>
</body>
</html>
