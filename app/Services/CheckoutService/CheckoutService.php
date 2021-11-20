<?php

namespace App\Services\CheckoutService;

use App\Services\CheckoutService\Products\Products;
use App\Services\CheckoutService\Basket\Basket;

class CheckoutService
{
    private Object $products;
    private Object $basket;
    public Float $total = 0;

    public function __construct(array $pricing_rules)
    {
        $this->products = new Products();
        $this->basket = new Basket($pricing_rules);
    }
    
    public function scan(string $product_code) : void
    {
        $product = $this->products->findByCode($product_code);
        $this->basket->addItemToBasket($product);
        $this->total = $this->basket->getTotal();
    }
}