<?php
require_once '../src/Database.php';
require_once '../src/ProductManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $db = Database::getInstance()->getConnection();
    $productManager = new ProductManager($db);
    
    if ($productManager->updateProduct($product_id, $name, $category_id, $price, $description)) {
        
        header('Location: add_product.php?update=success');
    } else {
        
        echo "Failed to update product.";
    }
}
