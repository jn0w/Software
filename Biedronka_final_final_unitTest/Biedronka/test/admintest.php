<?php
require_once '../src/Admin.php';
require_once '../src/User.php';


// Test 1: Basic Constructor and Role Verification
echo "Test 1: Basic Constructor and Role Verification<br>";
$admin1 = new Admin(1, "Jane", "Doe", "jane.doe@gmail.com", "pass123", "123 Admin St", "9876543210");
echo "Expected Role: admin. Actual Role: " . $admin1->getRole() . "<br>";
echo "Expected ID: 1. Actual ID: " . $admin1->getId() . "<br>";
echo "<br>";

// Test 2: Getter Methods
echo "Test 2: Getter Methods<br>";
echo "Name: " . $admin1->getFirstname() . " " . $admin1->getLastname() . "<br>";
echo "Email: " . $admin1->getEmail() . "<br>";
echo "Address: " . $admin1->getAddress() . "<br>";
echo "Contact Number: " . $admin1->getContactNumber() . "<br>";
echo "<br>";

// Test 3: Update Attributes
echo "Test 3: Update Attributes<br>";
$admin1->setEmail("new.jane.doe@example.com");
$admin1->setContactNumber("1234567890");
echo "Updated Email: " . $admin1->getEmail() . "<br>";
echo "Updated Contact Number: " . $admin1->getContactNumber() . "<br>";
echo "<br>";

// Test 4: Handling of Invalid Data
echo "Test 4: Handling of Invalid Data<br>";
$admin2 = new Admin(null, null, null, "bademail", null, null, null);
echo "Invalid ID: " . $admin2->getId() . "<br>";
echo "Invalid Email: " . $admin2->getEmail() . "<br>";  
echo "<br>";
?>
