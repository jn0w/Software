<?php

class Customer extends User {
    // Additional properties and methods specific to the Customer

    public function __construct($id, $firstname, $lastname, $email, $password, $address, $contact_number) {
        parent::__construct($id, $firstname, $lastname, $email, $password, 'customer', $address, $contact_number);
    }

    // Customer-specific methods can be added here
}