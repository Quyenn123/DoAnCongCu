<?php
#Loading composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

#Load ENV
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ .'/../');
$dotenv->load();

#Load Bridge
require_once __DIR__ . '/../systems/bridge.php';


#Start Server App
$app = new \System\Src\App();

/*

    =>trangchu.html => MainController(), function index
    =>danhmuc.html => MenuController(), function index
    =>lienhe.html => ContactController(), function index

    => san-pham/san-pham-abc => ProductController(), function index
    => san-pham/san-pham-bcd => ProductController(), function index
*/

// $main = new MainController();
// echo $main->index();

// call_user_func_array([$main, 'index'], ['id' => 1]);

