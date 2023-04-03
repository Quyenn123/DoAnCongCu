<?php

namespace App\Controllers\Admin;

use App\Middleware\Auth;

class UploadController extends Auth
{
    public function __construct()
    {
        parent::__construct();
    }

    private function ext()
    {
        return [
            'image' => [
                'image/jpg'
            ],
            'videos' => [
                'audio/mp4'
            ]
        ];
    }

    public function upload()
    {
        if (!$this->isMethod('post')) {
            return json(['error' => true, 'message' => 'Phương thức không chính xác']);
        }

        $path = $this->getFolder();

        #kiểm tra có tồn tại file hay không
        if ($_FILES['file']['name'] == '') {
            return json(['error' => true, 'message' => 'Vui lòng chọn file']);
        } 

        if (getimagesize($_FILES['file']['tmp_name']) === false) {
            return json(['error' => true, 'message' => 'File ảnh không đúng định dạng']);
        }

        $maxSize = 1024 * 1000 * 5;  //5mb
        if ($_FILES['file']['size'] > $maxSize) {
            return json(['error' => true, 'message' => 'Kích thước tối đa là 5mb']);
        }
        
        $pathFull = $path . basename($_FILES['file']['name']);
        if (file_exists($pathFull)) { #nếu tồn tại file
            $pathFull = $path . rand(99, 99999999) . '_' . basename($_FILES['file']['name']);
        }

        #upload file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $pathFull)) {
            return json(['error' => false, 'url' => '/' . $pathFull]);
        }

        return json(['error' => true, 'message' => 'Upload lỗi']);
    }

    function getFolder($path = 'uploads/')
    {
        $array = [date('Y'), date('m'), date('d')];
        foreach ($array as $item) {
            $path .= $item . '/';

            if (is_dir($path) === false) {
                mkdir($path, 0775);
            }
        }

        return $path;
    }
}