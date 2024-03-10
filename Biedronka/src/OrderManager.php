<?php
require_once 'Database.php'; // Adjust the path as needed
require_once 'Manager.php';

class OrderManager extends Manager{
    //protected $db;

    //public function __construct($db) {
      //  $this->db = $db;
    //}

    public function getOrderDetails($order_id) {
        // Assuming you have a single table for orders that includes guest orders
        // and your order items are stored in an `order_items` table
        $orderSql = "SELECT * FROM guest_orders WHERE order_id = :order_id";
        $stmt = $this->db->prepare($orderSql);
        $stmt->execute([':order_id' => $order_id]);
        $orderDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($orderDetails) {
            // Fetch the items for this order
            $itemsSql = "SELECT oi.product_id, oi.quantity, oi.price, p.name 
                         FROM order_items oi
                         JOIN products p ON oi.product_id = p.product_id
                         WHERE oi.order_id = :order_id";
            $stmt = $this->db->prepare($itemsSql);
            $stmt->execute([':order_id' => $order_id]);
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Add the items to the order details
            $orderDetails['items'] = $items;
        }

        return $orderDetails;
    }

    public function getAllOrders() {
        $stmt = $this->db->prepare("SELECT * FROM guest_orders ORDER BY order_id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function deleteOrder($order_id) {
        try {
            // Begin transaction
            $this->db->beginTransaction();

            // Delete order items first to maintain referential integrity
            $deleteItemsSql = "DELETE FROM order_items WHERE order_id = :order_id";
            $stmt = $this->db->prepare($deleteItemsSql);
            $stmt->execute([':order_id' => $order_id]);

            // Delete the order
            $deleteOrderSql = "DELETE FROM guest_orders WHERE order_id = :order_id";
            $stmt = $this->db->prepare($deleteOrderSql);
            $stmt->execute([':order_id' => $order_id]);

            // Commit transaction
            $this->db->commit();
            
            return true;
        } catch (Exception $e) {
            // Roll back transaction if any error occurs
            $this->db->rollBack();
            // Optionally log the error or handle it as needed
            return false;
        }
    }
}
