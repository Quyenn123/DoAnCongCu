<?php

namespace App\Models;

use System\Src\Model;

class CartModel extends Model
{
    protected $table = 'carts';

    public function insert($data = [])
    {
        return $this->inserMultiple($data, $this->table);
    }
}