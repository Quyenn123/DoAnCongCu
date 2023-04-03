<?php

namespace App\Models;

use System\Src\Model;

class ProductModel extends Model
{
    protected $table = 'products';

    public function insert($data)
    {
        return $this->insertFirst($data, $this->table);
    }

    public function get($limit = 10, $offset = 0)
    {
        $sql = "SELECT $this->table.*, menus.title as title_menu 
            FROM $this->table left JOIN menus on $this->table.menu_id = menus.id 
            order by $this->table.id desc limit $limit offset $offset";
        
        return $this->query($sql);
    }

    public function countRows($isActive = null)
    {
        $sql = "SELECT id from $this->table ";

        if ($isActive != null) {
            $sql .= " where is_active = 1";
        }
        
        return $this->numRow($sql);
    }

    public function getByIsActive($limit = 12, $offset = 0, $menuId = 0)
    {
        $sql = "SELECT id, title, price, price_sale, thumb from $this->table where is_active = 1";
        if ($menuId != 0) { $sql .= " && menu_id = $menuId "; }
        $sql .= " order by id desc limit $limit offset $offset ";

        return $this->query($sql);
    }

    public function getByIsActiveLoadMore($limit = 12, $offset = 0, $menuId = 0, $sort = 'desc', $arrayPrice = [])
    {
        $sql = "SELECT id, title, price, price_sale, thumb from $this->table 
                where is_active = 1 && menu_id = $menuId ";

        //Kiểm tra giá tiền
        if (count($arrayPrice) == 2) {
            $sql .= " && price between " . $arrayPrice[0] . " and " . $arrayPrice[1];
        }

        $sql .= " order by id $sort limit $limit offset $offset ";

        return $this->getArrray($sql);
    }

    public function countRowsByMenuId(int $menuId)
    {
        $sql = "SELECT id from $this->table where menu_id = $menuId && is_active = 1";
        
        return $this->numRow($sql);
    }

    public function getProductById(int $id = 0)
    {
        $sql = "select products.*, menus.title as menu_title from $this->table
             left JOIN menus on $this->table.menu_id = menus.id 
             where $this->table.id = $id && $this->table.is_active = 1";

        return $this->first($sql);
    }

    public function getMoreProduct(int $id)
    {
        $sql = "SELECT id, title, price, price_sale, thumb from $this->table 
                where is_active = 1 && id != $id order by id desc limit 8 ";
                
        return $this->query($sql);
    }
}