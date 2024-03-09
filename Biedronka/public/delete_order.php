<?php
require_once '../src/Database.php'; // Adjust path as needed
require_once '../src/OrderManager.php'; // Adjust path as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $db = Database::getInstance()->getConnection();
    $orderManager = new OrderManager($db);
    
    $order_id = $_POST['order_id'];
    
    // Call a method to delete the order. You need to implement this method in OrderManager.
    $success = $orderManager->deleteOrder($order_id);
    
    if ($success) {
        // Redirect back to add_product.php with a success message
        header('Location: add_product.php?msg=OrderDeleted');
    } else {
        // Redirect back with an error message
        header('Location: add_product.php?msg=OrderDeleteFailed');
    }
} else {
    // Redirect back if the request method is not POST
    header('Location: add_product.php');
}
exit();
