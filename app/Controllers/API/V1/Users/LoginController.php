<?php

namespace App\Controllers\API\V1\Users;

use System\Src\Controller;
use App\Models\UserModel;
use System\Src\Token;

class LoginController extends Controller
{
    protected $userModel;
    protected $token;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->token = new Token();
    }

    public function store()
    {
        if ($this->isMethod('POST') == false) {
            return json(['error' => true, 'message' => 'Phương thức không hổ trợ']);
        }

        if ($this->input('email') == null || $this->input('password') == null) {
            return json(['error' => true, 'message' => 'Email và mật khẩu không được trống']);
        }

        $user = $this->userModel->getUser($this->input('email'));
        if ($user == null) {
            return json(['error' => true, 'message' => 'Địa chỉ Email không tồn tại']);
        }
        
        if (! password_verify($this->input('password'), $user['password'])) {
            return json(['error' => true, 'message' => 'Mật khẩu không đúng']);
        }

        if ($user['is_active'] != 1) {
            return json(['error' => true, 'message' => 'Tài khoản đã bị khóa']);
        }

        if ($user['level'] != 1) {
            return json(['error' => true, 'message' => 'Bạn không có quyền truy cập']);
        }


        return json([
            'error' => false,
            'user' => $user,
            'access_token' => $this->token->get($user),
            'refresh_token' => generateUUID()
        ]);
    }
}