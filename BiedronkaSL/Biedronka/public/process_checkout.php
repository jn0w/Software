<?php
session_start();
require_once '../src/Database.php';
require_once '../src/ProductManager.php';
require_once '../src/Product.php';

$db = Database::getInstance()->getConnection();
$productManager = new ProductManager($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['basket'])) {
    // Retrieve user ID if the user is logged in
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Continue with the rest of the data retrieval from $_POST
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];
    $paymentMethod = $_POST['payment_method'];

    // Calculate the total price of the basket items
    $totalPrice = 0;
    foreach ($_SESSION['basket'] as $productId => $quantity) {
        $product = $productManager->getProductById($productId);
        if ($product instanceof Product) { 
            $totalPrice += $product->getPrice() * $quantity;
        }
    }

    try {
        $db->beginTransaction();
        
        // Include user_id in the INSERT statement for guest_orders
        $insertOrderSql = "INSERT INTO guest_orders (user_id, name, address, contact_number, email, payment_method, status, total_price) VALUES (?, ?, ?, ?, ?, ?, 'Pending', ?)";
        $orderStmt = $db->prepare($insertOrderSql);
        // Pass the $userId as the first parameter in the execute() call
        $orderStmt->execute([$userId, $name, $address, $contactNumber, $email, $paymentMethod, $totalPrice]);
        $orderId = $db->lastInsertId();

        // Insert order items
        $insertItemSql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $itemStmt = $db->prepare($insertItemSql);
        foreach ($_SESSION['basket'] as $productId => $quantity) {
            $product = $productManager->getProductById($productId);
            if ($product instanceof Product) {
                $itemStmt->execute([$orderId, $productId, $quantity, $product->getPrice()]);
            }
        }

        $db->commit();

        // Clear the basket and redirect to the order confirmation page
        $_SESSION['basket'] = [];
        header('Location: order_confirmation.php?order_id=' . $orderId);
        exit();
    } catch (Exception $e) {
        $db->rollBack();
        exit('Order placement failed: ' . $e->getMessage());
    }
} else {
    header('Location: checkout.php');
    exit();
}

