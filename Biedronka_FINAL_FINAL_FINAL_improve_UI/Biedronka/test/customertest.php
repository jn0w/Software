<?php
require_once '../src/User.php';
require_once '../src/Customer.php';

// Test 1: Verifying that all properties are set and retrieved correctly
echo "Test 1: Expected correct instantiation and getter methods<br>";
$customer1 = new Customer(1, "John", "Doe", "test@example.com", "password123", "123 Main St", "1234567890");
echo "Expected value for getId(): 1. Actual value: " . $customer1->getId() . "<br>";
echo "Expected value for getFirstname(): John. Actual value: " . $customer1->getFirstname() . "<br>";
echo "Expected value for getLastname(): Doe. Actual value: " . $customer1->getLastname() . "<br>";
echo "Expected value for getEmail(): test@example.com. Actual value: " . $customer1->getEmail() . "<br>";
echo "Expected value for getPassword(): password123. Actual value: " . $customer1->getPassword() . "<br>";
echo "Expected value for getRole(): customer. Actual value: " . $customer1->getRole() . "<br>";
echo "Expected value for getAddress(): 123 Main St. Actual value: " . $customer1->getAddress() . "<br>";
echo "Expected value for getContactNumber(): 1234567890. Actual value: " . $customer1->getContactNumber() . "<br>";
echo "<br>";

// Test 2: Testing the system's handling of different data types for properties
echo "Test 2: Checking for correct instantiation with mixed data types<br>";
$customer2 = new Customer("2", "Jane", "Doe", "jane@example.com", "password456", "456 Main St", (int) "0987654321");
// Confirming that the ID remains a string type after instantiation
$idIsString = is_string($customer2->getId());
echo "Expected value for getId() to be string '2': '2'. Actual value: " . $customer2->getId() . ". Is actual type string? " . ($idIsString ? "Yes" : "No") . "<br>";
// Confirming that the contact number is converted to an integer type
$contactIsInt = is_int($customer2->getContactNumber());
echo "Expected value for getContactNumber() to be integer from string '0987654321': 987654321. Actual value: " . $customer2->getContactNumber() . ". Is actual type int? " . ($contactIsInt ? "Yes" : "No") . "<br>";
echo "<br>";

// Test 3: Ensuring that properties can handle empty strings as input
echo "Test 3: Instantiation with empty string parameters<br>";
$customer3 = new Customer('', '', '', '', '', '', '');
// Verifying that empty string inputs are handled as expected
echo "Expected value for getId(): (empty). Actual value: '" . $customer3->getId() . "'<br>";
echo "Expected value for getFirstname(): (empty). Actual value: '" . $customer3->getFirstname() . "'<br>";
echo "Expected value for getLastname(): (empty). Actual value: '" . $customer3->getLastname() . "'<br>";
echo "Expected value for getEmail(): (empty). Actual value: '" . $customer3->getEmail() . "'<br>";
echo "Expected value for getPassword(): (empty). Actual value: '" . $customer3->getPassword() . "'<br>";
echo "Expected value for getRole(): (empty). Actual value: '" . $customer3->getRole() . "'<br>";
echo "Expected value for getAddress(): (empty). Actual value: '" . $customer3->getAddress() . "'<br>";
echo "Expected value for getContactNumber(): (empty). Actual value: '" . $customer3->getContactNumber() . "'<br>";
echo "<br>";

// Test 4: Confirming that setter methods update properties correctly
echo "Test 4: Testing setter methods<br>";
$customer4 = new Customer(4, "Initial", "Name", "initial@example.com", "initialPassword", "Initial Address", "1111111111");
// Updating properties using setters and verifying updates
$customer4->setFirstname("Updated");
$customer4->setLastname("Name");
$customer4->setEmail("updated@example.com");
$customer4->setPassword("updatedPassword");
$customer4->setAddress("Updated Address");
$customer4->setContactNumber("2222222222");
echo "Expected updated firstname: Updated. Actual value: " . $customer4->getFirstname() . "<br>";
echo "Expected updated lastname: Name. Actual value: " . $customer4->getLastname() . "<br>";
echo "Expected updated email: updated@example.com. Actual value: " . $customer4->getEmail() . "<br>";
echo "Expected updated password: updatedPassword. Actual value: " . $customer4->getPassword() . "<br>";
echo "Expected updated address: Updated Address. Actual value: " . $customer4->getAddress() . "<br>";
echo "Expected updated contact number: 2222222222. Actual value: " . $customer4->getContactNumber() . "<br>";
echo "<br>";
?>
