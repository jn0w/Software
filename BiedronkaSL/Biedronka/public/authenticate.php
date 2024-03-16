<?php
require_once '../src/UserManager.php'; 

session_start();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$userManager = new UserManager();

$user = $userManager->authenticate($email, $password);

if ($user) {
    // Authentication successful
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role']; 

    // Redirect to a protected page or dashboard
    header('Location: index.php');
    exit();
} else {
    // Authentication failed
    $_SESSION['error_message'] = 'Invalid credentials';
    // Redirect back to the login page
    header('Location: login.php');
    exit();
}
?>
