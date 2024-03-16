<?php
require_once '../src/Database.php'; // Adjust the path as needed
require_once '../src/User.php';
require_once '../src/Customer.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address = htmlspecialchars($_POST['address']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $role = htmlspecialchars($_POST['role']);

    // Assuming Customer is a valid class that prepares the user data for insertion
    $customer = new Customer(null, $firstname, $lastname, $email, $password, $address, $contact_number);

    $database = Database::getInstance();
    $db = $database->getConnection();
    
    $stmt = $db->prepare("INSERT INTO users (firstname, lastname, email, password, role, address, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$firstname, $lastname, $email, $password, $role, $address, $contact_number])) {
        // Redirect to index.php after successful registration
        header('Location: index.php');
        exit(); // Ensure no further code is executed after redirect
    } else {
        // Display a button to go back to the registration page if registration failed
        echo "Registration failed! <br>";
        echo "<a href='register.php'><button>Go Back</button></a>";
    }  
}
?>
