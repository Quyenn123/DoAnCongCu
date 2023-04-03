<?php

namespace App\Services\Products;

use System\Src\Session;

class ProductService
{
    public function handlePrice(float $price = 0, float $priceSale = 0) : bool
    {
        if ($price != 0 && $priceSale != 0 && $price <= $priceSale) {
            Session::flash('errors', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if ($price == 0 && $priceSale != 0) {
            Session::flash('errors', 'Phải có giá gốc mới nhập được giá giảm');
            return false;
        }

        return true;
    }
}