<?php
$adminPassword = '1234567890'; // Replace with the actual admin password
$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);
echo $hashedPassword;
?>