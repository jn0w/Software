<?php
require_once '../src/ProductManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    
    $productManager = new ProductManager();
    $deleted = $productManager->deleteProduct($productId);
    
    if ($deleted) {
        // Redirect back to add_product.php with a success message
        header('Location: add_product.php?message=Product+Deleted+Successfully');
    } else {
        // Redirect back with an error message
        header('Location: add_product.php?error=Unable+to+Delete+Product');
    }
} else {
    // Redirect if the request method is not POST or product_id is not set
    header('Location: add_product.php');
}
