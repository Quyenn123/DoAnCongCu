<?php

namespace App\Controllers\Admin;

use App\Middleware\Auth;
use App\Models\MenuModel;
use App\Models\ProductModel;
use System\Src\Session;
use App\Services\Products\ProductService;
use System\Src\Paginate;

class ProductController extends Auth
{
    protected $menuModel;
    protected $productService;
    protected $productModel;

    public function __construct()
    {
        parent::__construct();
        $this->menuModel = new MenuModel;
        $this->productService = new ProductService;
        $this->productModel = new ProductModel;
    }

    public function create()
    {
        return view('admin/main', [
            'title' => 'Thêm Sản Phẩm',
            'template' => 'products/add',
            'menus' => $this->menuModel->getAllMenuIsActive()
        ]);
    }

    public function store()
    {
        if (! $this->isMethod('post')) {
            Session::flash('error', 'Phương thức không hổ trợ');
            return redirect('/admin/products/add');
        }

        if ($this->input('title') == null || $this->input('thumb') == null) {
            Session::flash('error', 'Tiêu đề hoặc Ảnh không được trống');
            return redirect('/admin/products/add');
        }

        #Kiểm tra giá tiền
        $isValidatePrice = $this->productService->handlePrice(
            (float) $this->input('price'), 
            (float) $this->input('price_sale')
        );

        if ($isValidatePrice == false) return redirect('/admin/products/add');

        $product = $this->productModel->insert($this->input());
        if ($product) {
            Session::flash('success', 'Thêm sản phẩm mới thành công');
            return redirect('/admin/products/add');
        }

        Session::flash('errors', 'Có lỗi vui lòng thử lại');
        return redirect('/admin/products/add');
    }

    public function index()
    {
        $page = (int)$this->input('page');
        $page = $page > 1 ? $page : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $numRows = $this->productModel->countRows();

        return view('admin/main', [
            'title' => 'Danh Sách Sản Phẩm - Trang ' . $page,
            'template' => 'products/list',
            'products' => $this->productModel->get($limit, $offset),
            'pages' => Paginate::view($numRows, $limit, $page, '/admin/products/lists')
        ]);
    }
}