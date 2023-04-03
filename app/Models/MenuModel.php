<?php

namespace App\Models;

use System\Src\Model;

class MenuModel extends Model
{
    protected $table = 'menus';
    const PARENT_ID = 0;
    const IS_ACTIVE = 1;

    public function insert($data)
    {
        return $this->insertFirst($data, $this->table);
    }

    public function get(int $parentId = -1)
    {
        $sql = "SELECT * from $this->table ";

        #Xử lý chỉ lấy cha
        if ($parentId == self::PARENT_ID) {
            $sql .= " where parent_id = " . $parentId;
            return $this->query($sql);
        }

        return $this->getArrray($sql); 
    }

    public function show($id)
    {
        $sql = "SELECT * from $this->table where id = $id ";

        return $this->first($sql);
    }

    public function update($data, $id)
    {
        return $this->updateOne($data, $id, $this->table);
    }

    public function delete($id)
    {
        return $this->query("DELETE from $this->table where id = $id");
    }

    public function getAllMenuIsActive()
    {
        return $this->getArrray("SELECT * from $this->table where is_active = " . self::IS_ACTIVE);
    }

    public function getAllMenuIsActiveParent()
    {
        return $this->query("SELECT * from $this->table 
            where is_active = " . self::IS_ACTIVE . " && parent_id = 0
            order by sort_by desc ");
    }

    public function showIsActive($id)
    {
        $sql = "SELECT * from $this->table where id = $id && is_active = 1";

        return $this->first($sql);
    }
}