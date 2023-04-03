<?php

namespace App\Controllers\Admin\Users;

use System\Src\Controller;
use System\Src\Session;
use App\Models\UserModel;

class LoginController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

        if (Session::get('email') != null) {
            return redirect('/admin/main');
        }
    }

    public function login()
    {
        return view('admin/users/login');
    }

    public function store()
    {
        if ($this->isMethod('POST') == false) {
            Session::flash('errors', 'Phương thức không hổ trợ');
            return redirect('/admin/users/login');
        }

        if ($this->input('email') == null || $this->input('password') == null) {
            Session::flash('errors', 'Email và mật khẩu không được trống');
            return redirect('/admin/users/login');
        }

        //Mã hóa
        // $has = password_hash('123456', PASSWORD_BCRYPT);
        //var_dump(password_verify('123456', $has));

        $user = $this->userModel->getUser($this->input('email'));
        if ($user == null) {
            Session::flash('errors', 'Địa chỉ Email không tồn tại');
            return redirect('/admin/users/login');
        }
        
        if (! password_verify($this->input('password'), $user['password'])) {
            Session::flash('errors', 'Mật khẩu không đúng');
            return redirect('/admin/users/login');
        }

        if ($user['is_active'] != 1) {
            Session::flash('errors', 'Tài khoản đã bị khóa');
            return redirect('/admin/users/login');
        }

        if ($user['level'] != 1) {
            Session::flash('errors', 'Bạn không có quyền truy cập');
            return redirect('/admin/users/login');
        }

        ///Login thành công
        if ((int) $this->input('remember') == 1) {
            setcookie('email', $this->input('email'), time() + (60 * 86400), '/');
            setcookie('password', $this->input('password'), time() + (60 * 86400), '/');
        }

        Session::flash('email', $this->input('email'));
        Session::flash('password', $this->input('password'));

        return redirect('/admin/main');
    }
}