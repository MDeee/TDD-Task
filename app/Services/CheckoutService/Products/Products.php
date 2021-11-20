<?php

namespace App\Services\CheckoutService\Products;

use App\Services\CheckoutService\Products\Product;

class Products {

    private Array $products = [];

    public function __construct()
    {
        $this->addProduct(new Product('CF1', 'Cofee', 11.23));
        $this->addProduct(new Product('FR1', 'Fruit Tea', 3.11));
        $this->addProduct(new Product('SR1', 'Strawberry', 5.00));
    }

    private function addProduct(Product $product) : void
    {
        $this->products[] = $product;
    }

    public function all() : array
    {
        return $this->products;
    }

    public function findByCode(string $product_code)
    {
        foreach ($this->products as $product) {
            if ($product->getCode() === $product_code) {
                return $product;
            }
        }
    }
}