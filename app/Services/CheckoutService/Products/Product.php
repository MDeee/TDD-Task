<?php

namespace App\Services\CheckoutService\Products;

class Product {

    private String $code;
    private String $name;
    private Float $price;

    public function __construct(String $code, String $name, Float $price)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    public function getCode() : string
    {
        return $this->code;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getPrice() : float
    {
        return $this->price;
    }
}