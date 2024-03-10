<?php


class User {
    protected $id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $role;
    protected $address;
    protected $contact_number;

    public function __construct($id, $firstname, $lastname, $email, $password, $role, $address, $contact_number) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->address = $address;
        $this->contact_number = $contact_number;
    }

    // Common methods like getters and setters can be added here
}