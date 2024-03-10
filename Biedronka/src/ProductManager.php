<?php

require_once 'Database.php';
require_once 'Manager.php';

class ProductManager extends Manager {
    //private $db;

    //public function __construct() {
      //  $this->db = Database::getInstance()->getConnection();
    //}

    public function addProduct(Product $product) {
        $stmt = $this->db->prepare("INSERT INTO products (name, category_id, price, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $product->name,
            $product->category_id, 
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


    public function getProductsGroupedByCategory() {
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY category_id, name");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $groupedProducts = [];
        foreach ($products as $product) {
            // Normalize the category name to lowercase before grouping
            $category = strtolower($product['category_id']);
            $groupedProducts[$category][] = $product;
        }
        return $groupedProducts;
    }

    public function getProductById($productId) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE product_id = :productId");
        $stmt->bindValue(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetches a single product
    }

    public function updateProduct($product_id, $name, $category_id, $price, $description) {
        try {
            $sql = "UPDATE products SET name = :name, category_id = :category_id, price = :price, description = :description WHERE product_id = :product_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':product_id', $product_id);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle error, maybe log it and return false or throw a custom exception
            return false;
        }
    }
}
