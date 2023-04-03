<?php

namespace System\Src;

class Request
{
    protected function isMethod($method = 'GET')
    {
        return strtoupper($_SERVER['REQUEST_METHOD']) == strtoupper($method);
    }

    protected function input($key = null)
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $data = [];
        
        switch ($method)  
        {
            case 'GET':
                $data = $this->getValue($_GET);
                break;

            case 'POST':
                $data = $this->getValue($_POST);
                break;   
        }

        if ($key == null) return $data;
    
        return isset($data[$key]) && !empty($data[$key]) ? $data[$key] : null;
    }

    private function getValue(array $items = []) : array
    {
        $data = [];
        foreach ($items as $key => $value) {
            Session::flash($key, $value);

            $data = array_merge($data, [
                $key => is_array($value) ? $value : makeSafe($value)
            ]);
        }

        return $data;
    }
}