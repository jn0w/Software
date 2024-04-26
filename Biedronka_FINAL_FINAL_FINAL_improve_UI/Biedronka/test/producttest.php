<?php
require_once '../src/Product.php';

// Test 1: Basic Constructor and Getter Methods
echo "Test 1: Basic Constructor and Getter Methods<br>";
$product1 = new Product(1, "Widget", 19.99, "A useful widget.", 101);
echo "Expected ID: 1. Actual ID: " . $product1->getId() . "<br>";
echo "Expected Name: Widget. Actual Name: " . $product1->getName() . "<br>";
echo "Expected Price: 19.99. Actual Price: " . $product1->getPrice() . "<br>";
echo "Expected Description: A useful widget. Actual Description: " . $product1->getDescription() . "<br>";
echo "Expected Category ID: 101. Actual Category ID: " . $product1->getCategory() . "<br>";
echo "<br>";

// Test 2: Type Check
echo "Test 2: Type Check<br>";
echo "ID is an integer? " . (is_int($product1->getId()) ? "Yes" : "No") . "<br>";
echo "Name is a string? " . (is_string($product1->getName()) ? "Yes" : "No") . "<br>";
echo "Price is a float? " . (is_float($product1->getPrice()) ? "Yes" : "No") . "<br>";
echo "Description is a string? " . (is_string($product1->getDescription()) ? "Yes" : "No") . "<br>";
echo "Category ID is an integer? " . (is_int($product1->getCategory()) ? "Yes" : "No") . "<br>";
echo "<br>";

// Test 3: Negative Price Test
echo "Test 3: Negative Price Test<br>";
$product2 = new Product(2, "Gadget", -9.99, "A possibly controversial gadget.", 102);
echo "Expected Price: -9.99. Actual Price: " . $product2->getPrice() . "<br>";
echo "<br>";

// Test 4: Edge Cases
echo "Test 4: Edge Cases<br>";
// Creating a new product with deliberately extreme input values to test the robustness of the Product class.
// ID is set to 3, which is a normal value.
// Name is set to a string of 1000 'X' characters to test if the class can handle very long strings.
// Price is set to 100.00, a normal value for this test.
// Description is set to a string of 2000 'Y' characters to test how well the class handles extremely long descriptions.
// Category ID is set to 0, often considered an invalid value in systems where ID starts from 1, to check how the class handles an edge case ID.
$product3 = new Product(3, str_repeat("X", 1000), 100.00, str_repeat("Y", 2000), 0);

// Displaying a message that we are testing long strings for name and description.
echo "Testing extremely long name and description.<br>";

// Checking the length of the name to confirm it has correctly stored and handled the 1000-character long string.
echo "Name Length: " . strlen($product3->getName()) . " characters.<br>";

// Checking the length of the description to confirm it has correctly stored and handled the 2000-character long string.
echo "Description Length: " . strlen($product3->getDescription()) . " characters.<br>";

// Testing for an invalid or edge case category ID.
echo "Testing invalid category ID (0).<br>";

// Checking if the category ID was handled or stored correctly even if it was set to 0.
echo "Category ID: " . $product3->getCategory() . "<br>";
echo "<br>";

?>
