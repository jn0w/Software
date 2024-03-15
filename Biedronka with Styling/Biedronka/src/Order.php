<?php

class Order {
    private $orderId;
    private $products;
    private $totalPrice;
    private $name;
    private $address;
    private $contactNumber;
    private $email;
    private $paymentMethod;

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
