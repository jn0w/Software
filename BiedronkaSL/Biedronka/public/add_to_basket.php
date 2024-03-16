<?php
session_start();


if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}


if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    
    if ($quantity > 0) {
        
        if (isset($_SESSION['basket'][$productId])) {
            $_SESSION['basket'][$productId] += $quantity;
        } else {
            
            $_SESSION['basket'][$productId] = $quantity;
        }
        
        
        $_SESSION['success_message'] = 'Product added to basket successfully.';
    } else {
        
        $_SESSION['error_message'] = 'Invalid quantity.';
    }
} else {
    
    $_SESSION['error_message'] = 'Product ID or quantity missing.';
}


header('Location: products.php');
exit();
