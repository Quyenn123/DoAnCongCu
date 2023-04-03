<?php

namespace System\Src;

class Auth
{
    public static function user()
    {
        return \System\Src\Session::get('auth');
    }
}