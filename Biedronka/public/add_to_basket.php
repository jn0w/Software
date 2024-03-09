<?php
session_start();

// Initialize the basket if it doesn't exist
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}

// Check if the product ID and quantity were sent
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Validate quantity
    if ($quantity > 0) {
        // If the product is already in the basket, update the quantity
        if (isset($_SESSION['basket'][$productId])) {
            $_SESSION['basket'][$productId] += $quantity;
        } else {
            // Otherwise, add the product with its quantity to the basket
            $_SESSION['basket'][$productId] = $quantity;
        }
        
        // Optionally, add a success message to the session to display later
        $_SESSION['success_message'] = 'Product added to basket successfully.';
    } else {
        // Optionally, add an error message to the session to display later
        $_SESSION['error_message'] = 'Invalid quantity.';
    }
} else {
    // Optionally, add an error message to the session to display later
    $_SESSION['error_message'] = 'Product ID or quantity missing.';
}

// Redirect back to the products page or to the basket view
header('Location: products.php');
exit();
