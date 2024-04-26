<?php

require_once 'Database.php';
require_once 'Manager.php';
require_once 'User.php'; 

class UserManager extends Manager {
    
    // Attempts to authenticate a user based on the provided email and password.
    public function authenticate($email, $password) {
        // Prepares the SQL statement to search for the user by email.
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If a user is found and the password matches, returns a new User object with the user's details.
        if ($userData && password_verify($password, $userData['password'])) {
            return new User(
                $userData['id'],
                $userData['firstname'],
                $userData['lastname'],
                $userData['email'],
                $userData['password'], 
                $userData['role'],
                $userData['address'],
                $userData['contact_number']
            );
        }
    
        // Returns null if the user cannot be authenticated.
        return null;
    }


}
