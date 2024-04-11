<?php

require_once 'Database.php';
require_once 'Manager.php';
require_once 'Product.php';

class ProductManager extends Manager {

    public function addProduct(Product $product) {
        //insert statement with product details
        $stmt = $this->db->prepare("INSERT INTO products (name, category_id, price, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $product->getName(),
            $product->getCategory(),
            $product->getPrice(),
            $product->getDescription()
        ]);
        return $this->db->lastInsertId();
    }

    public function getAllProducts() {
        //get all products
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();
        $productsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $products = [];

        //product array to product objects
        foreach ($productsArray as $productData) {
            $products[] = new Product(
                $productData['product_id'],
                $productData['name'],
                $productData['price'],
                $productData['description'],
                $productData['category_id']
            );
        }

        return $products;
    }

    public function deleteProduct($productId) {
        //delete statement for product object
        $stmt = $this->db->prepare("DELETE FROM products WHERE product_id = ?");
        return $stmt->execute([$productId]);
    }

    public function getProductsGroupedByCategory() {
        //get products grouped by category
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY category_id, name");
        $stmt->execute();
        $productsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $groupedProducts = [];

        //group products by category
        foreach ($productsArray as $productData) {
            $product = new Product(
                $productData['product_id'],
                $productData['name'],
                $productData['price'],
                $productData['description'],
                $productData['category_id']
            );
            $groupedProducts[strtolower($product->getCategory())][] = $product;
        }

        return $groupedProducts;
    }

    public function getProductById($productId) {
        //get product by id
        $stmt = $this->db->prepare("SELECT * FROM products WHERE product_id = :productId");
        $stmt->bindValue(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($productData) {
            return new Product($productData['product_id'], $productData['name'], $productData['price'], $productData['description'], $productData['category_id']);
        } else {
            return null;
        }
    }

    public function updateProduct($product_id, $name, $category_id, $price, $description) {
        //update product details
        $sql = "UPDATE products SET name = ?, category_id = ?, price = ?, description = ? WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([$name, $category_id, $price, $description, $product_id]);
    }
}
