<?php
require_once '../src/Database.php';
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

    
    $customer = new Customer(null, $firstname, $lastname, $email, $password, $address, $contact_number);

    
    $database = Database::getInstance();
    $db = $database->getConnection();
    
    $stmt = $db->prepare("INSERT INTO users (firstname, lastname, email, password, role, address, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$firstname, $lastname, $email, $password, $role, $address, $contact_number])) {
        echo "Registration successful!";
        
    } else {
        echo "Registration failed!";
        
    }
}
?>
