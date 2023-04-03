<?php

use App\Controllers\Admin\MainController;
use App\Controllers\Admin\MenuController;
use App\Controllers\Admin\ProductController;
use App\Controllers\Admin\SliderController;
use App\Controllers\Admin\UploadController;
use App\Controllers\Admin\Users\LoginController;
use App\Controllers\TestController;

#http://php-18-10-2022.vtest/nuoc-hoa-nam-id38.html
#http://php-18-10-2022.vtest/nuoc-hoa-nam.html

#Menu
$_Routes['danh-muc/{slug}-id{id}.html'] = [App\Controllers\MenuController::class, 'index'];
$_Routes['services/load-product-by-menu'] = [App\Controllers\MenuController::class, 'show'];

$_Routes['admin/users/login'] = [LoginController::class, 'login'];
$_Routes['admin/users/login/store'] = [LoginController::class, 'store'];

$_Routes['admin/main'] = [MainController::class, 'index'];
$_Routes['admin'] = [MainController::class, 'index'];

///Phần Admin
#Menu
$_Routes['admin/menus/add'] = [MenuController::class, 'create'];
$_Routes['admin/menus/store'] = [MenuController::class, 'store'];
$_Routes['admin/menus/lists'] = [MenuController::class, 'index'];
$_Routes['admin/menus/edit/{id}'] = [MenuController::class, 'edit'];
$_Routes['admin/menus/update/{id}'] = [MenuController::class, 'update'];
$_Routes['admin/menus/delete'] = [MenuController::class, 'remove'];

#Product
$_Routes['admin/products/add'] = [ProductController::class, 'create'];
$_Routes['admin/products/store'] = [ProductController::class, 'store'];
$_Routes['admin/products/lists'] = [ProductController::class, 'index'];

#Slider
$_Routes['admin/sliders/add'] = [SliderController::class, 'create'];
$_Routes['admin/sliders/store'] = [SliderController::class, 'store'];
$_Routes['admin/sliders/lists'] = [SliderController::class, 'index'];

$_Routes['admin/upload'] = [UploadController::class, 'upload'];

$_Routes['test'] = [TestController::class, 'index'];

#Cart
$_Routes['cart/add'] = [App\Controllers\CartController::class, 'store'];
$_Routes['cart'] = [App\Controllers\CartController::class, 'index'];
$_Routes['cart/update'] = [App\Controllers\CartController::class, 'update'];
$_Routes['cart/delete/{id}'] = [App\Controllers\CartController::class, 'delete'];
$_Routes['cart/order'] = [App\Controllers\CartController::class, 'order'];

# Product
$_Routes['{slug}-id{id}.html'] = [App\Controllers\ProductController::class, 'index'];