<?php

namespace  System\Src;

use Exception;
use mysqli;

class DB
{
    protected $conn;

    public function __construct()
    {
        $connection = $_ENV['DB_CONNECTION'];

        switch ($connection)
        {
            case 'mongodb':
                $this->conn = $this->mongodb();
                break;

            default :
                $this->conn = $this->mysql();
        }
    }

    protected function mysql()
    {
        $conn = new mysqli(
            $_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'],
            $_ENV['DB_DATABASE'], $_ENV['DB_PORT']
        );

        if ($conn->connect_error) {
            throw new Exception($conn->connect_error, 500);
        }

        $conn->set_charset('utf8');

        return $conn;
    }

    protected function mongodb()
    {

    }
}