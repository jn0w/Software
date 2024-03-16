<?php
session_start();

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    
    if (isset($_SESSION['basket'][$productId])) {
        unset($_SESSION['basket'][$productId]);
        
        
        $_SESSION['message'] = "Item removed successfully.";
    }
}


header('Location: view_basket.php');
exit();
