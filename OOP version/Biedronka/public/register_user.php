<?php
require_once '../src/Database.php'; // Adjust the path as needed
require_once '../src/User.php'; // Assumes User class is properly defined
require_once '../src/Customer.php'; // Assumes Customer class is properly defined

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Use htmlspecialchars to sanitize input before using it
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $address = htmlspecialchars($_POST['address']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $role = htmlspecialchars($_POST['role']);

    // Create a new Customer object
    $customer = new Customer(null, $firstname, $lastname, $email, $password, $address, $contact_number);

    // Save the customer data to the database
    $database = Database::getInstance();
    $db = $database->getConnection();
    
    $stmt = $db->prepare("INSERT INTO users (firstname, lastname, email, password, role, address, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$firstname, $lastname, $email, $password, $role, $address, $contact_number])) {
        echo "Registration successful!";
        // Redirect to a login page or user dashboard
    } else {
        echo "Registration failed!";
        // Handle the error accordingly
    }
}
?>
