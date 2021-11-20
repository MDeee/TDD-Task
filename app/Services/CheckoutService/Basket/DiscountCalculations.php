<?php

namespace App\Services\CheckoutService\Basket;

class DiscountCalculations {

    protected function get_one_free(Array $product, Array $discount) : float
    {
        return ( floor( $product['qty'] / $discount['qty'] ) + $product['qty'] % $discount['qty'] ) * $product['price'];
    }

    protected function bulk_purchase(Array $product, Array $discount) : float
    {
        return $product['qty'] >= $discount['qty'] ? $product['qty'] * $discount['price'] : $product['qty'] * $product['price'];
    }
}