<?php

class Admin extends User {


    public function __construct($id, $firstname, $lastname, $email, $password, $address, $contact_number) {
        parent::__construct($id, $firstname, $lastname, $email, $password, 'admin', $address, $contact_number);
    }


}
