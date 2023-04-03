<?php

namespace System\Src;

class Session
{
    public static function flash($key = '', $message = null)
    {
        $_SESSION[$key] = $message;

        return ;
    }

    public static function has($key = '')
    {
        return $_SESSION[$key] ?? false;
    }

    public static function get($key = '')
    {
        return $_SESSION[$key] ?? null;
    }

    public static function getFlash($key = '')
    {
        if ($key == '') return '';

        if (self::has($key)) {
            echo $_SESSION[$key];
            unset($_SESSION[$key]);
        }
       
        return ;
    }

    public static function remove($key = '')
    {
        unset($_SESSION[$key]);
        return;
    }
}