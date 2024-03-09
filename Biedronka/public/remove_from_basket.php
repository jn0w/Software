<?php
session_start();

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Check if the product is in the basket and remove it
    if (isset($_SESSION['basket'][$productId])) {
        unset($_SESSION['basket'][$productId]);
        
        // Optionally, add a success message
        $_SESSION['message'] = "Item removed successfully.";
    }
}

// Redirect back to the basket page
header('Location: view_basket.php');
exit();
