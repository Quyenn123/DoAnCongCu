<?php

namespace System\Src;

use Exception;

class Route
{
    protected $controller = 'App\Controllers\MainController';
    protected $method = 'index';
    protected $params = [];
    protected $query = null;

    public function __construct()
    {
        $this->handleQuery();

        $controller = $this->handleController();

        //Kiểm tra 404
        if ($this->query != null && $controller == null) {
            throw new Exception('Lỗi 404', 404);
        }

        if ($controller !== null && count($controller) == 2) {
            $this->controller = $controller[0];
            $this->method = $controller[1];
        }
    }

    private function handleQuery()
    {
        if (isset($_GET['qMVC']) && !empty($_GET['qMVC'])) {
            $this->query = trim($_GET['qMVC'], '/'); //Loại bỏ khoảng trắng 2 bên
        }

        return $this;
    }

    private function handleController()
    {
        //Kiểm tra link người dùng vào
        if ($this->query === null) return null;

        global $_Routes;

        #Nếu link người dùng vào khớp với $_Routes thì trả về kết quả
        if (isset($_Routes[$this->query]) && !empty($_Routes[$this->query])) {
            return $_Routes[$this->query];
        }

        #nếu link là dạng động
        #Đếm cấp từ người dùng truyền vào, mỗi cấp là một dấu /
        $countQuery = count(explode('/', $this->query));
        
        foreach ($_Routes as $key => $value) {
            $countKeyByRoute = count(explode('/', $key));

            if ($countQuery === $countKeyByRoute) {
                #Chuyển {slug} về dạng regex để so sánh. Dữ liệu gốc: #san-pham/nuoc-hoa.html #san-pham/{slug}.html
                $pregexString = preg_replace('/{(.*?)}/i', '([a-zA-Z0-9\-]+)', $key); #san-pham/([a-zA-Z0-9\-]+).html
                $pregexStringNew = '/' . str_replace('/', '\/', $pregexString) . '/i'; #/san-pham\/([a-zA-Z0-9\-]+).html/i

                #Kiểm tra nếu thỏa điều kiện
                if (preg_match($pregexStringNew, $this->query, $matches)) {
                    #Xóa bớt ở $matches
                    unset($matches[0]);

                    #Lấy biến khai báo từ routes
                    preg_match_all('/{(.*?)}/i', $key, $keyMatches);

                    $this->params = array_combine($keyMatches[1], array_values($matches));
                    
                    return $value;
                }
            }
        }

        return null;
    }
}