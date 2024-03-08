<?php

require_once 'Database.php';

class ProductManager {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function addProduct(Product $product) {
        $stmt = $this->db->prepare("INSERT INTO products (name, category_id, price, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $product->name,
            $product->category_id, // Updated to use category_id
            $product->price,
            $product->description
        ]);
        return $this->db->lastInsertId();
    }


    public function getAllProducts() {
        $stmt = $this->db->prepare("SELECT product_id, name, category_id, price, description FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function deleteProduct($productId) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE product_id = ?");
        return $stmt->execute([$productId]);
    }

    // Additional methods for read, update, and delete can be added here
}
