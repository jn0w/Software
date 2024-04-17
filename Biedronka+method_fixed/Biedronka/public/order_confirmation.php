<?php
// check if session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//include needed classes
require_once '../src/OrderManager.php';
require_once '../src/Order.php';
require_once '../src/Product.php';
require_once '../src/Database.php';

//database connection
$database = Database::getInstance();
$db = $database->getConnection();

// Initialize OrderManager with the database connection
$orderManager = new OrderManager($db);
//variable to store order details
$order = null;

// Check if an order ID is provided in the GET request
if (isset($_GET['order_id'])) {
    // Get the order ID from the GET request
    $orderId = $_GET['order_id'];
    // fetch the order details using the ordermanager
    $order = $orderManager->getOrderDetails($orderId);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../css/orderconfirm.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="confirmation-container">
        <?php if ($order): ?>
        <h2>Order Confirmation</h2>
        <p>Thank you for your order, <?= htmlspecialchars($order->getName()) ?>!</p>
        <div class="order-details">
            <h3>Order Details:</h3>
            <ul>
                <li>Order Number: <?= htmlspecialchars($order->getOrderId()) ?></li>
                <li>Name: <?= htmlspecialchars($order->getName()) ?></li>
                <li>Address: <?= htmlspecialchars($order->getAddress()) ?></li>
                <li>Contact Number: <?= htmlspecialchars($order->getContactNumber()) ?></li>
                <li>Email: <?= htmlspecialchars($order->getEmail()) ?></li>
                <li>Total Price: €<?= htmlspecialchars(number_format($order->getTotalPrice(), 2)) ?></li>
                <li>Payment Method: <?= htmlspecialchars($order->getPaymentMethod()) ?></li>
            </ul>
        </div>
        <h3>Items Ordered:</h3>
        <ul>
            <?php foreach ($order->getProducts() as $product): ?>
                <li><?= htmlspecialchars($product['quantity']) ?> x <?= htmlspecialchars($product['product']->getName()) ?> @ €<?= htmlspecialchars(number_format($product['product']->getPrice(), 2)) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>There was a problem retrieving your order details. Please contact customer support.</p>
        <?php endif; ?>

        <div class="continue-shopping">
            <a href="products.php">Continue Shopping</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
