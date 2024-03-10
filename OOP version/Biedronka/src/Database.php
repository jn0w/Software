<?php

// src/Database.php

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        require_once __DIR__ . '/../config.php'; // Update the path to where your config.php file is located

        try {
            $this->connection = new PDO($dsn, $username, $password, $options);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
