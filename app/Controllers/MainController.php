<?php

namespace App\Controllers;

use System\Src\Controller;
use App\Models\SliderModel;
use App\Models\MenuModel;
use App\Models\ProductModel;
use System\Src\Paginate;

class MainController extends Controller
{
    protected $sliderModel;
    protected $menuModel;
    protected $productModel;

    public function __construct()
    {
        $this->sliderModel = new SliderModel;
        $this->menuModel = new MenuModel;
        $this->productModel = new ProductModel;
    }

    public function index()
    {
        $page = (int)$this->input('page');
        $page = $page > 1 ? $page : 1;
        $limit = 12;
        $offset = ($page - 1) * $limit;
        $numRows = $this->productModel->countRows();

        return view('main', [
            'title' => 'Trang web demo Bán hàng',
            'template' => 'home',
            'description' => 'Đây là mô tả của 1 trang',
            'sliders' => $this->sliderModel->getActive(),
            'menus' => $this->menuModel->getAllMenuIsActiveParent(),
            'products' => $this->productModel->getByIsActive($limit, $offset),
            'pages' => Paginate::view($numRows, $limit, $page, '/')
        ]);
    }
}