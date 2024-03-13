<?php

require_once 'Database.php';
require_once 'ProductManager.php';
require_once 'Product.php';

// This script should be run once to initialize the database with sample products.

function createSampleProducts($productManager) {
    $sampleProducts = [
        ['Watermelon', 'Fruit', 0.99, 'fresh delicious watermelon.'],
        ['Milk', 'Meat', 1.49, 'Fresh whole milk, 1 liter.'],
        ['Carrot', 'Vegetable', 0.69, 'Organic and crunchy carrots.'],
        ['bottle', 'Other', 5, 'Stylish metal bottle.'],
        ['test', 'Other', 5, 'test.'],
        // Add more categories and sample products as needed
    ];

    foreach ($sampleProducts as $sample) {
        [$name, $category, $price, $description] = $sample;
        $product = new Product(null, $name, $price, $description, $category);
        $productManager->addProduct($product);
    }
}

// Initialize the ProductManager
$db = Database::getInstance()->getConnection();
$productManager = new ProductManager($db);

// Create sample products
createSampleProducts($productManager);

echo "Sample products have been added to the database.\n";

?>
