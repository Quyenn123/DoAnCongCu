<?php

namespace App\Controllers;

use System\Src\Controller;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class TestController extends Controller
{
    public function index()
    {
        // $cache = new FilesystemAdapter();

        // $value = $cache->get('post_5555', function (ItemInterface $item) {
        //     $item->expiresAfter(120); // 120 giây
        
        //     return '777';
        // });
        
        // echo $value;

    }
}