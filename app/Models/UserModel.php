<?php

namespace App\Models;

use System\Src\Model;

class UserModel extends Model
{
    protected $table = 'users';

    public function getUser($email)
    {
        $sql = "SELECT * from $this->table where email = '$email' ";
       
        return $this->first($sql);
    }
}