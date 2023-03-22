<?php

namespace App\Helpers;

use App\Models\Product;

class GeneralHelper
{
    public static function get_expected_profit(Product $product)
    {
        $profit = $product->price * $product->quantity;

        return $profit;
    }
}