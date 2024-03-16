<?php

class Customer extends User {
    

    public function __construct($id, $firstname, $lastname, $email, $password, $address, $contact_number) {
        parent::__construct($id, $firstname, $lastname, $email, $password, 'customer', $address, $contact_number);
    }

    
}