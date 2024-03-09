<?php

class Order {
    private $products = [];
    private $totalPrice = 0.00;

    public function addProduct(Product $product, $quantity) {
        $this->products[] = [
            'product' => $product,
            'quantity' => $quantity
        ];
        $this->totalPrice += $product->getPrice() * $quantity;
    }

    public function getProducts() {
        return $this->products;
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }

    
}