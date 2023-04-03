<?php

namespace System\Src;

use Exception;

class Model extends DB
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  params $sql
     */
    protected function query($sql = '')
    {
        if ($sql == '') {
            throw new Exception('Sql not empty', 500);
        }

        $query = $this->conn->query($sql);
        if ($this->conn->error) {
            throw new Exception($this->conn->error, 500);
        }

        return $query;
    }

    public function numRow($sql = '')
    {
        $query = $this->query($sql);

        return $query->num_rows;
    }

    protected function getArrray($sql = '')
    {
        $result = $this->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    /* 
    *
    */
    protected function first($sql = '')
    {
        $query = $this->query($sql);
        if ($query == null) return null;

        return $query->fetch_assoc();
    }

    protected function insertFirst($data = [], $table = null)
    {
        if (count($data) == 0 || $table == null) {
            throw new Exception('Có lỗi: Data truyền vào trống hoặc Bảng không tồn tại', 500);
        } 
   
        $field = $value = '';

        foreach ($data as $key => $item) {
            $field .= $key . ', ';
            $value .= "'" . $item . "', ";
        }

        $field = substr(trim($field), 0, -1);
        $value = substr(trim($value), 0, -1);
        
        $sql = "INSERT into $table ($field) values ($value) ";

        return $this->query($sql);
    }

    protected function updateOne($data = [], $id = 0, $table = null)
    {
        if (count($data) == 0 || $id == 0 || $table == null) {
            throw new Exception('Có lỗi: Data truyền vào trống hoặc Bảng không tồn tại', 500);
        }

        $sql = "UPDATE $table set ";
        
        foreach ($data as $key => $item) {
            $sql .= $key . " = '" . $item . "', ";
        }

        $sql = substr(trim($sql), 0, -1);
        $sql .= " where id = $id ";

        return $this->query($sql);
    }

    protected function inserMultiple($data = [], $table = '')
    {
        if (count($data) == 0) {
            throw new Exception('Data is empty');
        }

        $field = $value = '';
        foreach ($data as $key => $item) {
            $x = '(';
            foreach ($item as $key2 => $item2) {
                if ($key == 0) { $field .= $key2 . ', '; }
                $x .= "'" . $item2 . "', ";
            }

            $x = substr(trim($x), 0, -1);
            $x .= '), ';
            $value .= $x;
        }

        $field = substr(trim($field), 0, -1);
        $value = substr(trim($value), 0, -1);
        
        $sql = "INSERT into $table ($field) values $value";

        return $this->query($sql);
    }
}