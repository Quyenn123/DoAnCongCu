<?php

namespace App\Models;

use System\Src\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';

    public function insert($data = [])
    {
        $now = date('Y-m-d H:i:s');
  
        $result = $this->insertFirst(array_merge($data, [
            'created_at_int' => strtotime($now),
            'created_at' => $now,
            'updated_at' => $now
        ]), $this->table);
     
        return $result ? $this->conn->insert_id : null;
    }
}