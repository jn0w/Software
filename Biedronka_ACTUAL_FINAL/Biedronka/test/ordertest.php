<?php
require_once '../src/Product.php';  // Include the Product class
require_once '../src/Order.php';    // Include the Order class

// Test 1: Basic Constructor and Getter Methods
// This test verifies that the constructor properly sets and the getters correctly retrieve each field.
echo "Test 1: Basic Constructor and Getter Methods<br>";
$order1 = new Order(1, "John Doe", "123 Main St", "123-456-7890", "john.doe@example.com", "Credit Card");
echo "Expected Name: John Doe. Actual Name: " . $order1->getName() . "<br>";
echo "Expected Address: 123 Main St. Actual Address: " . $order1->getAddress() . "<br>";
echo "Expected Contact Number: 123-456-7890. Actual Contact Number: " . $order1->getContactNumber() . "<br>";
echo "Expected Email: john.doe@example.com. Actual Email: " . $order1->getEmail() . "<br>";
echo "Expected Payment Method: Credit Card. Actual Payment Method: " . $order1->getPaymentMethod() . "<br>";
echo "<br>";

// Test 2: Adding Products and Calculating Total Price
// This test checks that products are added correctly and that total price calculations are accurate.
echo "Test 2: Adding Products and Calculating Total Price<br>";
$product = new Product(100, "Organic Apples", 1.99, "Fresh organic apples", 10);
$order1->addProduct($product, 5); // Adding 5 units of apples to the order
echo "Expected Total Price (5 apples at €1.99 each): 9.95. Actual Total Price: " . sprintf("%.2f", $order1->getTotalPrice()) . "<br>";
echo "<br>";

// Test 3: Handling Multiple Product Additions
// This test ensures the order can handle multiple types of products and still calculate the total price correctly.
echo "Test 3: Handling Multiple Product Additions<br>";
$product2 = new Product(101, "Almond Milk", 3.50, "Unsweetened almond milk, 1 liter", 11);
$order1->addProduct($product2, 2); // Adding 2 units of almond milk to the order
echo "Expected Total Price (5 apples + 2 almond milk): 16.95. Actual Total Price: " . sprintf("%.2f", $order1->getTotalPrice()) . "<br>";
echo "<br>";

// Test 4: Default and Null Values
// This test checks that default constructor values are handled correctly and do not cause errors.
echo "Test 4: Default and Null Values<br>";
$order2 = new Order(); // Creating an order without any initial values to test defaults
echo "Expected Default Name: (empty). Actual Name: '" . $order2->getName() . "'
<br>";
echo "Expected Default Address: (empty). Actual Address: '" . $order2->getAddress() . "'

<br>";
echo "Expected Default Contact Number: (empty). Actual Contact Number: '" . $order2->getContactNumber() . "'

<br>";
echo "Expected Default Email: (empty). Actual Email: '" . $order2->getEmail() . "'

<br>";
echo "Expected Default Payment Method: (empty). Actual Payment Method: '" . $order2->getPaymentMethod() . "'

<br>";
echo "<br>";
?>