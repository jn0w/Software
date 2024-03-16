<?php
require_once '../config.php'; // Ensure this path points to your actual config file

// Define admin credentials (use actual and secure values for production)
$adminFirstName = "admin";
$adminLastName = "admin";
$adminEmail = "admin@gmail.com";
$adminPassword = "admin!"; // Choose a strong, unique password
$adminRole = "admin"; // Assuming 'admin' is a valid role in your `role` column
$adminAddress = "admin"; // Provide an appropriate value
$adminContactNumber = "admin"; // Provide an appropriate value

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
        // Prepare the SQL statement to insert the new admin
        $stmt = $connection->prepare("INSERT INTO users (firstname, lastname, email, password, role, address, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Execute the statement with the provided admin information
        $stmt->execute([$adminFirstName, $adminLastName, $adminEmail, $passwordHash, $adminRole, $adminAddress, $adminContactNumber]);

        echo "Admin account created successfully.\n";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
