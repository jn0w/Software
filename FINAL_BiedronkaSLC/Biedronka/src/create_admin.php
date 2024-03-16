<?php
require_once '../config.php'; 

// Define admin 
$adminFirstName = "admin";
$adminLastName = "admin";
$adminEmail = "admin@gmail.com";
$adminPassword = "admin!"; 
$adminRole = "admin"; 
$adminAddress = "admin"; 
$adminContactNumber = "admin"; 

try {
    // Create a new PDO connection
    $connection = new PDO($dsn, $username, $password, $options); // Your config file should define these variables

    // Hash the password for secure storage
    $passwordHash = password_hash($adminPassword, PASSWORD_DEFAULT);

    // Check if the admin user already exists to avoid duplicates
    $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$adminEmail]);
    $userExists = $stmt->fetch();

    if ($userExists) {
        echo "An admin account with this email already exists.\n";
    } else {
        // SQL statement to insert the new admin
        $stmt = $connection->prepare("INSERT INTO users (firstname, lastname, email, password, role, address, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Execute the statement with the provided admin information
        $stmt->execute([$adminFirstName, $adminLastName, $adminEmail, $passwordHash, $adminRole, $adminAddress, $adminContactNumber]);

        echo "Admin account created successfully.\n";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
