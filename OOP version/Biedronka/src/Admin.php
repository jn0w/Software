<?php

class Admin extends User {
    // Additional properties and methods specific to the Admin

    public function __construct($id, $firstname, $lastname, $email, $password, $address, $contact_number) {
        parent::__construct($id, $firstname, $lastname, $email, $password, 'admin', $address, $contact_number);
    }

    // Admin-specific methods can be added here
}
