<?php

namespace App\Services\CheckoutService\Basket;

use App\Services\CheckoutService\Basket\DiscountCalculations;

class BasketCalculations extends DiscountCalculations {

    private Object $pricing_rules;
    protected Float $total = 0;
    
    public function __construct(array $pricing_rules)
    {
        $this->pricing_rules = collect($pricing_rules);
    }
    
    protected function calcTotal(Array $products) : void
    {
        $total = 0;

        if (count($products) > 0) {
            foreach ($products as $product) {
                $discount = $this->getDiscount($product['product_code']);
                if ($discount) {
                    $total += $this->calcTotalWithDiscount($product, $discount);
                } else {
                    $total += $this->calculateTotal($product);
                }
            }
        }

        $this->total = $total;
    }

    private function getDiscount(String $product_code)
    {
        return $this->pricing_rules->where('product_code', $product_code)->first();
    }
    
    private function calcTotalWithDiscount(Array $product, Array $discount) : float
    {
        if (!method_exists($this, $discount['function_name'])) {
            throw new \ErrorException('The discount function does not found');
        } else {
            return $this->{$discount['function_name']}($product, $discount);
        }

        return 0;
    }

    private function calculateTotal($product) : float
    {
        return $product['qty'] * $product['price'];
    }

    public function getTotal() : float
    {
        return $this->total;
    }
}