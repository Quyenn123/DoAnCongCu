<?php

namespace App\Controllers;

use System\Src\Controller;
use App\Models\ProductModel;

class ProductController extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index($slug = '', $id = 0)
    {
        $product = $this->productModel->getProductById($id);
        if ($product == null) return redirect('/');

        return view('main', [
            'title' => $product['title'],
            'template' => 'products/content',
            'product' => $product,
            'products' => $this->productModel->getMoreProduct($id)
        ]);
    }
}