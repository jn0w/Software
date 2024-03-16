<?php

require_once 'Database.php';

class Manager {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
}