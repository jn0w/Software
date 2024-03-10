<?php
session_start();
require_once '../src/Database.php'; // Ensure this path is correct
require_once '../src/OrderManager.php'; // Ensure this path is correct
require_once '../src/Order.php'; // Make sure to include the Order class

$db = Database::getInstance()->getConnection();
$orderManager = new OrderManager($db);

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;

if (!$order_id) {
    echo "Order ID is missing.";
    exit;
}

$order = $orderManager->getOrderDetails($order_id);

if (!$order) {
    echo "Order not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Order Confirmation</h1>
    <?php if ($order instanceof Order): ?>
    <p>Thank you for your order, <?= htmlspecialchars($order->getName()) ?>!</p>
    <p>Your order number is <?= htmlspecialchars($order->getOrderId()) ?>.</p>
    <h2>Order Details:</h2>
    <ul>
        <li>Address: <?= htmlspecialchars($order->getAddress()) ?></li>
        <li>Contact Number: <?= htmlspecialchars($order->getContactNumber()) ?></li>
        <li>Email: <?= htmlspecialchars($order->getEmail()) ?></li>
        <li>Total Price: €<?= htmlspecialchars(number_format($order->getTotalPrice(), 2)) ?></li>
        <li>Payment Method: <?= htmlspecialchars($order->getPaymentMethod()) ?></li>
    </ul>
    <h3>Items Ordered:</h3>
    <ul>
        <?php foreach ($order->getProducts() as $item): ?>
            <li><?= htmlspecialchars($item['quantity']) ?> x <?= htmlspecialchars($item['product']->getName()) ?> @ €<?= htmlspecialchars(number_format($item['product']->getPrice(), 2)) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>There was a problem retrieving your order details. Please contact customer support.</p>
<?php endif; ?>

    <p><a href="products.php" class="btn">Continue Shopping</a></p>
</body>
</html>
