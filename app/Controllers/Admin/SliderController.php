<?php

namespace App\Controllers\Admin;

use App\Middleware\Auth;
use System\Src\Session;
use App\Models\SliderModel;

class SliderController extends Auth
{
    protected $sliderModel;

    public function __construct()
    {
        parent::__construct();
        $this->sliderModel = new SliderModel;
    }

    public function create()
    {
        return view('admin/main', [
            'title' => 'Thêm Slider',
            'template' => 'sliders/add'
        ]);
    }

    public function store()
    {
        if (! $this->isMethod('post')) {
            Session::flash('errors', 'Phương thức không chính xác');
            return redirect('/admin/sliders/add');
        }

        if ($this->input('title') == null || $this->input('thumb') == null) {
            Session::flash('errors', 'Tiêu đề và ảnh không được trống');
            return redirect('/admin/sliders/add');
        }

        $slider = $this->sliderModel->insert($this->input());
        if ($slider) {
            Session::flash('success', 'Thêm thành công Slider mới');
            return redirect('/admin/sliders/add');
        }

        Session::flash('errors', 'Có lỗi vui lòng thử lại sau');
        return redirect('/admin/sliders/add');
    }

    public function index()
    {
        return view('admin/main', [
            'title' => 'Danh Sách Slider',
            'template' => 'sliders/list',
            'sliders' => $this->sliderModel->get()
        ]);
    }
}