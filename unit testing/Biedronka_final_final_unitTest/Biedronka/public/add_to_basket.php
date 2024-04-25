<?php
session_start();

// Initialize the basket in the session if it doesn't exist
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}

require_once '../src/ProductManager.php';
require_once '../src/Product.php';


$db = Database::getInstance()->getConnection();
$productManager = new ProductManager($db);

// Check if the form has been submitted with a product ID and quantity
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Retrieve product information
    $product = $productManager->getProductById($productId);
    if ($product instanceof Product) {
        // Check that the quantity is greater than 0
        if ($quantity > 0) {
            // If the product already exists in the basket, increment the quantity
            if (isset($_SESSION['basket'][$productId])) {
                $_SESSION['basket'][$productId] += $quantity;
            } else {
                // If the product is not in the basket, add it with the specified quantity
                $_SESSION['basket'][$productId] = $quantity;
            }
            // Success message including the product name
            $_SESSION['success_message'] = 'Successfully added ' . htmlspecialchars($product->getName()) . ' to your basket.';
        } else {
            // Error message for invalid quantity
            $_SESSION['error_message'] = 'Invalid quantity. Please enter a positive number.';
        }
    } else {
        // Error message if product does not exist
        $_SESSION['error_message'] = 'Product not found. Please try again.';
    }
} else {
    // Error message if product ID or quantity is missing
    $_SESSION['error_message'] = 'Product ID or quantity missing.';
}

// Redirect the user back to the products page
header('Location: products.php');
exit();
?>
