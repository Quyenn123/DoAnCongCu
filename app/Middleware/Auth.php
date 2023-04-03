<?php

namespace App\Middleware;

use System\Src\Controller;
use System\Src\Session;
use App\Models\UserModel;

class Auth extends Controller
{
    public $user;
    public function __construct()
    {
        $email = Session::get('email');
        $pasword = Session::get('password');

        if ($email == null && $pasword == null) {
            $email = isset($_COOKIE['email']) && !empty($_COOKIE['email']) ? makeSafe($_COOKIE['email']) : null;
            $pasword = isset($_COOKIE['password']) && !empty($_COOKIE['password']) ? makeSafe($_COOKIE['password']) : null;
        }

        if ($email == null && $pasword == null) {
            return redirect('/admin/users/login');
        }

        $user = $this->handleUserLoginAdmin($email, $pasword);
        if ($user === false) {
            Session::remove('email');
            Session::remove('password');
            return redirect('/admin/users/login');
        }

        $this->user = $user;
        Session::flash('auth', $user);
    }

    private function handleUserLoginAdmin($email, $pasword)
    {
        $userModel = new UserModel();
        
        $user = $userModel->getUser($email);
        if ($user == null) {
            Session::flash('errors', 'Địa chỉ Email không tồn tại');
            return false;
        }
        
        if (! password_verify($pasword, $user['password'])) {
            Session::flash('errors', 'Mật khẩu không đúng');
            return false;
        }

        if ($user['is_active'] != 1) {
            Session::flash('errors', 'Tài khoản đã bị khóa');
            return false;
        }

        if ($user['level'] != 1) {
            Session::flash('errors', 'Bạn không có quyền truy cập');
            return false;
        }

        Session::flash('email', $email);
        Session::flash('password', $pasword);

        return $user;
    }
}