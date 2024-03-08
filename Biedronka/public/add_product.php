<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biedronka Grocery Store - Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    include 'navbar.php'; 
    require_once '../src/ProductManager.php';

    $productManager = new ProductManager();
    $products = $productManager->getAllProducts();
    ?>
    
    <form method="post" action="add_product_handler.php">
    <label for="name">Product Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="category">Category:</label>
    <input type="text" name="category" id="category" required> <!-- Changed type to text -->

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" step="0.01" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>

    <input type="submit" value="Add Product">
</form>

    <h2>Existing Products</h2>
    <table>
        <thead>
            <tr>
                <th>product_id</th>
                <th>Name</th>
                <th>Category ID</th>
                <th>Price</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['product_id']) ?></td>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['category_id']) ?></td>
            <td><?= htmlspecialchars($product['price']) ?></td>
            <td><?= htmlspecialchars($product['description']) ?></td>
            <td>
                <!-- Delete button -->
                <form action="delete_product.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure?');">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
    </table>
    
    <?php include 'footer.php'; ?>
</body>
</html>
