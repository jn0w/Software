<?php
require_once '../src/ProductManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    
    $productManager = new ProductManager();
    $deleted = $productManager->deleteProduct($productId);
    
    if ($deleted) {
        
        header('Location: add_product.php?message=Product+Deleted+Successfully');
    } else {
        
        header('Location: add_product.php?error=Unable+to+Delete+Product');
    }
} else {
    
    header('Location: add_product.php');
}
