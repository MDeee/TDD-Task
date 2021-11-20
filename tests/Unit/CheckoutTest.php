<?php

namespace Tests\Unit;

use App\Services\CheckoutService\CheckoutService;
use PHPUnit\Framework\TestCase;

class CheckoutTest extends TestCase
{

    private Array $pricing_rules = [
        ['product_code' => 'FR1', 'function_name' => 'get_one_free',  'qty' => 2, 'price' => 0 ,  'percentage' => ''],
        ['product_code' => 'SR1', 'function_name' => 'bulk_purchase', 'qty' => 3, 'price' => 4.5 ,'percentage' => '']
    ];
        
    /**
     * Basket 1 test.
     *
     * @return void
     */
    public function test_Basket_1()
    {
        $co = new CheckoutService($this->pricing_rules);
        
        $co->scan('FR1');
        $co->scan('SR1');
        $co->scan('FR1');
        $co->scan('FR1');
        $co->scan('CF1');

        $this->assertEquals(22.45 , $co->total);
    }
    
    /**
     * Basket 2 test.
     *
     * @return void
     */
    public function test_Basket_2()
    {
        $co = new CheckoutService($this->pricing_rules);
        
        $co->scan('FR1');
        $co->scan('FR1');

        $this->assertEquals(3.11 , $co->total);
    }

    /**
     * Basket 3 test.
     *
     * @return void
     */
    public function test_Basket_3()
    {
        $co = new CheckoutService($this->pricing_rules);
        
        $co->scan('SR1');
        $co->scan('SR1');
        $co->scan('FR1');
        $co->scan('SR1');

        $this->assertEquals(16.61 , $co->total);
    }
}
