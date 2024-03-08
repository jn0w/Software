<?php
session_start();

// Include the UserManager class
require_once '../src/UserManager.php';

// Check if form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Create UserManager instance and authenticate user
    $userManager = new UserManager();
    $user = $userManager->authenticate($email, $password);

    if ($user) {
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['id'];

        // Redirect to the appropriate page based on the role
        if ($user['role'] === 'admin') {
            header('Location: add_product.php');
        } else {
            // Redirect non-admin users to a standard user page
            header('Location: index.php');
        }
        exit;
    } else {
        // Authentication failed
        // Provide feedback or redirect as appropriate
        echo "Invalid email or password.";
    }
}
?>
