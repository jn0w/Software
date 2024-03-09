<?php
session_start();
require_once '../src/Database.php'; // Ensure this path is correct
require_once '../src/OrderManager.php'; // Ensure this path is correct

$db = Database::getInstance()->getConnection();
$orderManager = new OrderManager($db);

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;

if (!$order_id) {
    echo "Order ID is missing.";
    exit;
}

$orderDetails = $orderManager->getOrderDetails($order_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Biedronka Grocery Store</title>
    <link rel="stylesheet" href="../style.css"> <!-- Adjust the path as needed -->
</head>
<body>
    <h1>Order Confirmation</h1>
    <?php if (!empty($orderDetails)): ?>
        <p>Thank you for your order, <?= htmlspecialchars($orderDetails['name']) ?>!</p>
        <p>Your order number is <?= htmlspecialchars($order_id) ?>.</p>
        <h2>Order Details:</h2>
        <ul>
            <li>Address: <?= htmlspecialchars($orderDetails['address']) ?></li>
            <li>Contact Number: <?= htmlspecialchars($orderDetails['contact_number']) ?></li>
            <li>Email: <?= htmlspecialchars($orderDetails['email']) ?></li>
            <li>Total Price: €<?= htmlspecialchars(number_format($orderDetails['total_price'], 2)) ?></li>
            <li>Payment Method: <?= htmlspecialchars($orderDetails['payment_method']) ?></li>
        </ul>
        <h3>Items Ordered:</h3>
        <ul>
            <?php foreach ($orderDetails['items'] as $item): ?>
                <li><?= htmlspecialchars($item['quantity']) ?> x <?= htmlspecialchars($item['name']) ?> @ €<?= htmlspecialchars(number_format($item['price'], 2)) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>There was a problem retrieving your order details. Please contact customer support.</p>
    <?php endif; ?>

    <!-- Button to go back to the main page -->
    <p><a href="products.php" class="btn">Continue Shopping</a></p>

</body>
</html>
