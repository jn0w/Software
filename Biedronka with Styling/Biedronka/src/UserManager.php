<?php


require_once 'Database.php';
require_once "Manager.php";

class UserManager extends Manager{
    

    public function register($firstname, $lastname, $email, $password, $role, $address, $contact_number) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (firstname, lastname, email, password, role, address, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$firstname, $lastname, $email, $passwordHash, $role, $address, $contact_number]);
    }

    public function authenticate($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }

   
}
