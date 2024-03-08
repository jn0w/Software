<?php

class Product {
    public $id;
    public $name;
    public $category_id; 
    public $price;
    public $description;

    public function __construct($name, $category_id, $price, $description) {
        $this->name = $name;
        $this->category_id = $category_id; 
        $this->price = $price;
        $this->description = $description;
    }
}

