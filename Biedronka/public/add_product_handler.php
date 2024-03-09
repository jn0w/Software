<?php

// public/add_product_handler.php
require_once '../src/ProductManager.php';
require_once '../src/Fruit.php';
require_once '../src/Vegetable.php';
require_once '../src/Meat.php';
require_once '../src/Other.php'; // Assuming there's an 'Other' category

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have form validation and sanitization here
    $name = $_POST['name'];
    $category = $_POST['category']; // Correctly capturing the category from form input
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    // Use $category in your switch statement, not $category_id
    switch ($category) {
        case 'Fruit':
            $product = new Fruit($name, $category, $price, $description);
            break;
        case 'Vegetable':
            $product = new Vegetable($name, $category, $price, $description);
            break;
        case 'Meat':
            $product = new Meat($name, $category, $price, $description);
            break;
        case "Other":
            // Assuming 'Other' is a default case for products that don't fit in the above categories
            $product = new Other($name, $category, $price, $description); 
            break;
    }

    $productManager = new ProductManager();
    $productId = $productManager->addProduct($product);

    if ($productId) {
        echo "Product added successfully. Product ID is: " . $productId;
        // Optionally redirect to a confirmation page or back to the form
        // header('Location: success_page.php');
    } else {
        echo "Failed to add the product.";
        // Handle the error accordingly
    }

    echo '<a href="add_product.php"><button type="button">Add Another Product</button></a>';
}
?>
