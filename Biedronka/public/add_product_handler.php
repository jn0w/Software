<?php

// public/add_product_handler.php
require_once '../src/Product.php';
require_once '../src/ProductManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have form validation and sanitization here
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $product = new Product($name, $category_id, $price, $description);
    $productManager = new ProductManager();
    $productId = $productManager->addProduct($product);

    if ($productId) {
        echo "Product added successfully. Product ID is: " . $productId;
        // Redirect to a confirmation page or back to the form
        // header('Location: success_page.php');
    } else {
        echo "Failed to add the product.";
        // Handle the error accordingly
    }

    echo '<a href="add_product.php"><button type="button">Add Another Product</button></a>';
}
