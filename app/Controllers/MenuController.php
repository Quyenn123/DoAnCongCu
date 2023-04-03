<?php

namespace App\Controllers;

use System\Src\Controller;
use App\Models\MenuModel;
use App\Models\ProductModel;
use System\Src\Session;

class MenuController extends Controller
{
    protected $menuModel;
    protected $productModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->productModel = new ProductModel();
    }

    public function index(string $slug, int $id)
    {
        $menu = $this->menuModel->showIsActive($id);
        if ($menu == null) {
            Session::flash('error', 'ID không tồn tại hoặc chưa kích hoat');
            return redirect('/');
        }

        return view('main', [
            'title' => $menu['title'],
            'description' => $menu['description'],
            'template' => 'menus/list',
            'menu' => $menu,
            'products' => $this->productModel->getByIsActive(12, 0, $menu['id'])
        ]);
    }

    public function show()
    {
        $sort = $this->input('sort');
        if ($sort != null && !in_array($sort, ['desc', 'asc'])) {
            return json(['error' => true, 'message' => 'Định dạng sắp xếp không đúng']);
        }

        $page = (int)$this->input('page');
        $arrayPrice = [];

        #Kiểm tra giá tiền
        if ($this->input('price') != null) {
            $arrayPrice = explode('-', $this->input('price'));
            if (count($arrayPrice) != 2) {
                return json(['error' => true, 'message' => 'Định dạng tiền không đúng']);
            }
        }

        #kiểm tra danh mục truyền lên
        $menuId = (int) $this->input('menudId');
        $menu = $this->menuModel->showIsActive($menuId);
        if ($menu == null) {
            return json(['error' => true, 'message' => 'ID không tồn tại hoặc chưa kích hoạt']);
        }

        $offset = ($page - 1) * 12;
        $products = $this->productModel->getByIsActiveLoadMore(12, $offset, $menu['id'], $sort, $arrayPrice);

        return json(['error' => false, 'products' => $products]);
    }
}