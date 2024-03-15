<?php
require_once 'Database.php';
require_once 'Manager.php';

require_once 'Order.php';
require_once 'Product.php';

class OrderManager extends Manager {

    public function createOrder(Order $order) {
        try {
            $this->db->beginTransaction();
    
            $stmt = $this->db->prepare("INSERT INTO guest_orders (total_price, status) VALUES (?, 'Pending')");
            $stmt->execute([$order->getTotalPrice()]);
            $orderId = $this->db->lastInsertId();
            
            $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            foreach ($order->getProducts() as $item) {
                $stmt->execute([$orderId, $item['product']->getId(), $item['quantity'], $item['product']->getPrice()]);
            }
    
            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
    public function getOrderDetails($orderId) {
        $stmt = $this->db->prepare("SELECT * FROM guest_orders WHERE order_id = ?");
        $stmt->execute([$orderId]);
        $orderData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$orderData) {
            return null;
        }
    
        
        $order = new Order(
            $orderData['order_id'],
            $orderData['name'],
            $orderData['address'],
            $orderData['contact_number'],
            $orderData['email'],
            $orderData['payment_method']
        );
    
        
        $stmt = $this->db->prepare("SELECT p.*, oi.quantity FROM order_items oi JOIN products p ON oi.product_id = p.product_id WHERE oi.order_id = ?");
        $stmt->execute([$orderId]);
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = new Product($row['product_id'], $row['name'], $row['price'], $row['description'], $row['category_id']);
            $order->addProduct($product, $row['quantity']);
        }
    
        return $order;
    }

    public function getAllOrders() {
        $orders = [];
        $stmt = $this->db->prepare("SELECT order_id FROM guest_orders ORDER BY order_id DESC");
        $stmt->execute();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orders[] = $this->getOrderDetails($row['order_id']);
        }
    
        return $orders;
    }
    

    public function deleteOrder($orderId) {
        try {
            $this->db->beginTransaction();
    
            $stmt = $this->db->prepare("DELETE FROM order_items WHERE order_id = ?");
            $stmt->execute([$orderId]);
    
            $stmt = $this->db->prepare("DELETE FROM guest_orders WHERE order_id = ?");
            $stmt->execute([$orderId]);
    
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
    
}
