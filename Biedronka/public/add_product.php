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
    require_once '../src/Database.php';
    require_once '../src/ProductManager.php';
    require_once '../src/OrderManager.php';

    $db = Database::getInstance()->getConnection();

    $productManager = new ProductManager();
    $products = $productManager->getAllProducts();

    $orderManager = new OrderManager($db);
    $orders = $orderManager->getAllOrders();
    ?>

    <form method="post" action="add_product_handler.php">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required>

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
                <th>Product ID</th>
                <th>Name</th>
                <th>Category ID</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['product_id']) ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['category_id']) ?></td>
                    <td>€<?= htmlspecialchars($product['price']) ?></td>
                    <td><?= htmlspecialchars($product['description']) ?></td>
                    <td>
                        <form action="delete_product.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                            <input type="submit" value="Delete" onclick="return confirm('Are you sure?');">
                        </form>
                        <a href="update_product.php?product_id=<?= $product['product_id'] ?>" class="btn">Update</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Existing Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['order_id']) ?></td>
                    <td><?= htmlspecialchars($order['name']) ?></td>
                    <td><?= htmlspecialchars($order['email']) ?></td>
                    <td>€<?= htmlspecialchars($order['total_price']) ?></td>
                    <td><?= htmlspecialchars($order['payment_method']) ?></td>
                    <td>
                        <form action="delete_order.php" method="POST">
                            <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                            <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this order?');">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php include 'footer.php'; ?>
</body>
</html>
