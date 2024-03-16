<?php
require_once '../src/Database.php';
require_once '../src/OrderManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $db = Database::getInstance()->getConnection();
    $orderManager = new OrderManager($db);
    
    $order_id = $_POST['order_id'];
    
    
    $success = $orderManager->deleteOrder($order_id);
    
    if ($success) {
        
        header('Location: add_product.php?msg=OrderDeleted');
    } else {
        
        header('Location: add_product.php?msg=OrderDeleteFailed');
    }
} else {
    
    header('Location: add_product.php');
}
exit();
