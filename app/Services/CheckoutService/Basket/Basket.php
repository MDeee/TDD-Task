<?php

namespace App\Services\CheckoutService\Basket;

use App\Services\CheckoutService\Products\Product;
use App\Services\CheckoutService\Basket\BasketCalculations;

class Basket extends BasketCalculations {

    private Array $products = [];
    
    public function addItemToBasket($product) : void
    {
        if ($product) {
            $productInBasket = $this->findInBasket($product);
            if(count($productInBasket) > 0) {
                $this->incrementItem($product);
            } else {
                $this->addItem($product);
            }
            $this->calcTotal($this->products);
        } else {
            throw new \ErrorException('Product not found');
        }
    }

    private function findInBasket(Product $product) : Array
    {
        return array_filter($this->products, function ($p) use ($product) {
            return $p['product_code'] === $product->getCode();
        });
    }

    private function incrementItem(Product $productInBasket) : void
    {
        $this->products = array_map(function ($item) use ($productInBasket) {
            if ($item['product_code'] === $productInBasket->getCode()) {
                $item['qty'] = $item['qty'] + 1;
            }
            return $item;
        }, $this->products);
    }

    private function addItem(Product $product) : void
    {
        $this->products[] = [
            "product_code" => $product->getCode(),
            "price" => $product->getPrice(),
            "qty" => 1 
        ];
    }
}