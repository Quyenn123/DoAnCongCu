<?php

namespace App\Controllers\Admin;

use App\Middleware\Auth;
use System\Src\Session;
use App\Models\MenuModel;

class MenuController extends Auth
{
    protected $menuModel;

    public function __construct()
    {
        parent::__construct();
        $this->menuModel = new MenuModel;
    }

    public function create()
    {
        return view('admin/main', [
            'title' => 'Thêm Danh Mục Mới',
            'template' => 'menus/add',
            'menusParent' => $this->menuModel->get(0)
        ]);
    }

    public function store()
    {
        #kiểm tra phương thức
        if (! $this->isMethod('post')) {
            Session::flash('errors', 'Phương thức không chính xác');
            return redirect('/admin/menus/add');
        }

        if ($this->input('title') == null || $this->input('thumb') == null) {
            Session::flash('errors', 'Tiêu đề và ảnh đại diện không được trống');
            return redirect('/admin/menus/add');
        }

        $menu = $this->menuModel->insert($this->input());
        if ($menu) {
            Session::flash('success', 'Thêm danh mục mới thành công');
            return redirect('/admin/menus/add');
        }

        Session::flash('errors', 'Thêm danh mục mới lỗi');
        return redirect('/admin/menus/add');
    }

    public function index()
    {
        return view('admin/main', [
            'title' => 'Danh Sách Danh Mục',
            'template' => 'menus/list',
            'menus' => $this->menuModel->get()
        ]);
    }

    public function edit(int $id = 0)
    {
        //Lấy thông tin của id
        $menu = $this->menuModel->show($id);
        if ($menu == null) {
            Session::flash('errors', 'Id không tồn tại');
            return redirect('/admin/menus/lists');
        }

        return view('admin/main', [
            'title' => 'Chỉnh Sửa Danh Mục: ' . $menu['title'],
            'template' => 'menus/edit',
            'menu' => $menu,
            'menusParent' => $this->menuModel->get(0)
        ]);
    }

    public function update(int $id = 0)
    {
        #kiểm tra phương thức
        if (! $this->isMethod('post')) {
            Session::flash('errors', 'Phương thức không chính xác');
            return redirect('/admin/menus/lists');
        }

        if ($this->input('title') == null) {
            Session::flash('errors', 'Tiêu đề không được trống');
            return redirect('/admin/menus/lists');
        }

        //Lấy thông tin của id
        $menu = $this->menuModel->show($id);
        if ($menu == null) {
            Session::flash('errors', 'Id không tồn tại');
            return redirect('/admin/menus/lists');
        }

        $data = $this->input();
        if ($this->input('thumb') == null) {
            unset($data['thumb']);//xóa đi
        }

        $result = $this->menuModel->update($data, $id);
        if ($result) {
            Session::flash('success', 'Cập nhật thành công');
            return redirect('/admin/menus/lists');
        }

        Session::flash('errors', 'Cập nhật lỗi');
        return redirect('/admin/menus/lists');
    }

    public function remove()
    {
        if (! $this->isMethod('post')) {
            return json(['error' => true, 'message' => 'Phương thức không chính xác']);
        }

        $id = (int)$this->input('id');
        $menu = $this->menuModel->show($id);
        if ($menu == null) {
            return json(['error' => true, 'message' => 'Id không tồn tại']);
        }

        //Xóa ảnh /uploads/2022/10/01/name.jpg_delete
        if (file_exists(__PUBLIC__ . $menu['thumb'])) {
            unlink(__PUBLIC__ . $menu['thumb']);
        }

        $result = $this->menuModel->delete($id);

        return $result 
            ? json(['error' => false, 'message' => 'Xóa thành công'])
            : json(['error' => true, 'message' => 'Xóa lỗi']);
    }
}