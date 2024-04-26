<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../css/updateproduct.css">
</head>
<body>
    <?php 
    // needed classes
    include 'navbar.php';
    require_once '../src/Database.php';
    require_once '../src/ProductManager.php';

        //get product id
    $product_id = $_GET['product_id'] ?? null;
        //if product id is missing then error message
    if (!$product_id) {
        echo "Product ID is missing.";
        exit;
    }

    // database connection instance
    $db = Database::getInstance()->getConnection();
    //product manager instance with database connection
    $productManager = new ProductManager($db);
    //using product manager to get product by id
    $product = $productManager->getProductById($product_id);

    //if not found error message
    if (!$product) {
        echo "Product not found.";
        exit;
    }
    ?>

    <div class="container">
        <h1>Update Product</h1>
        <form method="post" action="update_product_handler.php">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product->getId()) ?>">

            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($product->getName()) ?>" required>

            <label for="category_id">Category ID:</label>
            <input type="text" name="category_id" id="category" value="<?= htmlspecialchars($product->getCategory()) ?>" required>

            <label for="price">Price:</label>
            <input type="number" name="price" id="price" value="<?= htmlspecialchars($product->getPrice()) ?>" step="0.01" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?= htmlspecialchars($product->getDescription()) ?></textarea>

            <button type="submit">Update Product</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
