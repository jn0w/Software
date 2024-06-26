<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biedronka Grocery Store - Add Product</title>
    <link rel="stylesheet" href="../css/addproduct.css">
    
</head>
<body>
<?php
    // Include the navbar at the top of the page
    include 'navbar.php';

    // Import necessary classes for database and product/order management
    require_once '../src/Database.php';
    require_once '../src/ProductManager.php';
    require_once '../src/OrderManager.php';

    // Establish a database connection
    $db = Database::getInstance()->getConnection();

    // Initialize ProductManager and retrieve all products for display
    $productManager = new ProductManager($db);
    $products = $productManager->getAllProducts();

    // Initialize OrderManager and retrieve all orders for display
    $orderManager = new OrderManager($db);
    $orders = $orderManager->getAllOrders();
    ?>

    <!-- Product and Order Display Section -->
    <div class="container">
        <!-- Form for adding a new product -->
        <div class="form-add-product">
            <h2>Add New Product</h2>
            <!-- When the form is submitted, data is sent to add_product_handler.php -->
            <form method="post" action="add_product_handler.php">
                <!-- Input fields for product details -->
                <label for="name">Product Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="category">Category:</label>
                <input type="text" name="category" id="category" required>

                <label for="price">Price:</label>
                <input type="number" name="price" id="price" step="0.01" required>

                <label for="description">Description:</label>
                <textarea name="description" id="description" required></textarea>

                <!-- Submission button for the form -->
                <input type="submit" value="Add Product">
            </form>
        </div>

        <!-- Table for displaying existing products -->
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
                <!-- Loop through each product and display its details in the table -->
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product->getId()) ?></td>
                        <td><?= htmlspecialchars($product->getName()) ?></td>
                        <td><?= htmlspecialchars($product->getCategory()) ?></td>
                        <td>€<?= htmlspecialchars(number_format($product->getPrice(), 2)) ?></td>
                        <td><?= htmlspecialchars($product->getDescription()) ?></td>
                        <td>
                            <!-- Form to delete a product -->
                            <form action="delete_product.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $product->getId() ?>">
                                <input type="submit" value="Delete" onclick="return confirm('Are you sure?');">
                            </form>
                            <!-- Link to update a product -->
                            <a href="update_product.php?product_id=<?= $product->getId() ?>" class="btn">Update</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Table for displaying existing orders -->
        <h2>Existing Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each order and display its details in the table -->
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order->getOrderId()) ?></td>
                        <td>€<?= htmlspecialchars(number_format($order->getTotalPrice(), 2)) ?></td>
                        <td>
                            <!-- Form to delete an order -->
                            <form action="delete_order.php" method="POST">
                                <input type="hidden" name="order_id" value="<?= $order->getOrderId() ?>">
                                <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this order?');">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Include the footer at the bottom of the page -->
    <?php include 'footer.php'; ?>
</body>
</html>

