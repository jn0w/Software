<?php

class Order {
    private $orderId;
    private $products;
    private $totalPrice;
    private $name; // Add name property
    private $address; // Add address property
    private $contactNumber; // Add contact number property
    private $email; // Add email property
    private $paymentMethod; // Add payment method property

    // Modify the constructor to accept these additional parameters
    public function __construct($orderId = null, $name = "", $address = "", $contactNumber = "", $email = "", $paymentMethod = "") {
        $this->orderId = $orderId;
        $this->name = $name;
        $this->address = $address;
        $this->contactNumber = $contactNumber;
        $this->email = $email;
        $this->paymentMethod = $paymentMethod;
        $this->products = [];
        $this->totalPrice = 0.0;
    }

    // Add getter methods for the new properties
    public function getName() {
        return $this->name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getContactNumber() {
        return $this->contactNumber;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    public function addProduct($product, $quantity) {
        $this->products[] = ['product' => $product, 'quantity' => $quantity];
        $this->calculateTotalPrice();
    }

    private function calculateTotalPrice() {
        $this->totalPrice = array_reduce($this->products, function ($total, $item) {
            return $total + ($item['product']->getPrice() * $item['quantity']);
        }, 0);
    }

    public function getProducts() {
        return $this->products;
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }

    public function getOrderId() {
        return $this->orderId;
    }
}
