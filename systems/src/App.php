<?php

namespace System\Src;

use Exception;

class App extends Route
{
    public function __construct()
    {
        try {
            #Chạy function khởi tạo của Cha
            parent::__construct();

            $controller = new $this->controller;

            call_user_func_array([$controller, $this->method], $this->params);
            
        } catch (Exception $error) {
           
            if ($error->getCode() == 404) {
                return view('errors/404'); 
            }

            dd((array) $error);
        }
    }
}