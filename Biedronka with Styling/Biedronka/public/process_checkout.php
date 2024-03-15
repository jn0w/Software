<?php
session_start();
require_once '../src/Database.php';
require_once '../src/ProductManager.php';
require_once '../src/Product.php';

$db = Database::getInstance()->getConnection();
$productManager = new ProductManager($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['basket'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];
    $paymentMethod = $_POST['payment_method'];

    
    $totalPrice = 0;
    foreach ($_SESSION['basket'] as $productId => $quantity) {
        $product = $productManager->getProductById($productId);
        if ($product instanceof Product) { 
            $totalPrice += $product->getPrice() * $quantity;
        }
    }

    try {
        $db->beginTransaction();

        
        $insertOrderSql = "INSERT INTO guest_orders (name, address, contact_number, email, payment_method, status, total_price) VALUES (?, ?, ?, ?, ?, 'Pending', ?)";
        $orderStmt = $db->prepare($insertOrderSql);
        $orderStmt->execute([$name, $address, $contactNumber, $email, $paymentMethod, $totalPrice]);
        $orderId = $db->lastInsertId();

        $insertItemSql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $itemStmt = $db->prepare($insertItemSql);
        foreach ($_SESSION['basket'] as $productId => $quantity) {
            $product = $productManager->getProductById($productId);
            if ($product instanceof Product) {
                $itemStmt->execute([$orderId, $productId, $quantity, $product->getPrice()]);
            }
        }

        $db->commit();

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
