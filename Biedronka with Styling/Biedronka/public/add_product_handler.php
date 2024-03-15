<?php

require_once '../src/ProductManager.php';
require_once '../src/Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = $_POST['name'];
    $category = $_POST['category']; 
    $price = $_POST['price'];
    $description = $_POST['description'];

    
    $product = new Product(null, $name, $price, $description, $category);

    $productManager = new ProductManager();
    $productId = $productManager->addProduct($product);

    if ($productId) {
        echo "Product added successfully. Product ID is: " . $productId;
        
    } else {
        echo "Failed to add the product.";
        
    }

    echo '<a href="add_product.php"><button type="button">Add Another Product</button></a>';
}
?>
