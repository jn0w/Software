<?php
require_once '../config.php';
require_once 'User.php'; 
require_once 'Admin.php'; 

// Admin details
$adminFirstName = "admin";
$adminLastName = "admin";
$adminEmail = "admin@gmail.com";
$adminPassword = "admin!";
$adminRole = "admin";
$adminAddress = "admin";
$adminContactNumber = "admin";

try {
    // Create a new PDO connection
    $connection = new PDO($dsn, $username, $password, $options); 

    // Check if the admin user already exists to avoid duplicates
    $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$adminEmail]);
    $userExists = $stmt->fetch();

    if ($userExists) {
        echo "An admin account with this email already exists.\n";
    } else {
        // Hash the password for secure storage
        $passwordHash = password_hash($adminPassword, PASSWORD_DEFAULT);

        // Create an Admin object
        $admin = new Admin(null, $adminFirstName, $adminLastName, $adminEmail, $passwordHash, $adminAddress, $adminContactNumber);

        // SQL statement to insert the new admin
        $stmt = $connection->prepare("INSERT INTO users (firstname, lastname, email, password, role, address, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Execute the statement with the admin object 
        $stmt->execute([
            $admin->getFirstname(),
            $admin->getLastname(),
            $admin->getEmail(),
            $admin->getPassword(), 
            $adminRole, 
            $admin->getAddress(),
            $admin->getContactNumber()
        ]);

        echo "Admin account created successfully.\n";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
