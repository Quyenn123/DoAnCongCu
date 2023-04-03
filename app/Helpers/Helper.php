<?php

namespace App\Helpers;

class Helper 
{
    public static function getMenuIsActiveShowSelect($menus, $parentId = 0, $string = '')
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu['parent_id'] == $parentId) { // so sánh oke
                $html .= '<option value="' . $menu['id'] . '">' . $string . $menu['title'] . '</option>';

                #xóa đi dữ liệu từ mảng gốc tại vì mình đã gọi ra rồi
                unset($menus[$key]);

                $html .= self::getMenuIsActiveShowSelect($menus, $menu['id'], '|-----' . $string);
            }
        }

        return $html;
    }

    public static function getMenuIsAdmin($menus, $parentId = 0, $string = '')
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu['parent_id'] == $parentId) { // so sánh oke
                $html .= '
                    <tr>
                        <td>' . $menu['id'] . '</td>
                        <td>' . $string . $menu['title'] . '</td>
                        <td>' . self::getIsActive($menu['is_active']) . '</td>
                        <td>
                            <a href="' . $menu['thumb']. '" target="_blank">
                                <img src="' . $menu['thumb']. '" style="width: 60px; height: 30px">
                            </a>
                        </td>
                        <td>' . $menu['updated_at'] . '</td>
                        <td><a href="/admin/menus/edit/' . $menu['id'] . '">Sửa</a></td>
                        <td><a href="#" onclick="deleteRow(' . $menu['id'] . ', \'/admin/menus/delete\')">Xóa</a></td>
                    </tr>
                ';

                #xóa đi dữ liệu từ mảng gốc tại vì mình đã gọi ra rồi
                unset($menus[$key]);

                $html .= self::getMenuIsAdmin($menus, $menu['id'], '|-----' . $string);
            }
        }

        return $html;
    }

    public static function getIsActive($active = 1)
    {
        return $active == 1
            ? '<span class="badge bg-success">Kích Hoạt</span>'
            : '<span class="badge bg-danger">Không kích hoạt</span>';
    }

    public static function getPrice($price = 0, $priceSale = 0)
    {
        if ($price == 0 && $priceSale == 0) {
            return '<a href="/lien-he.html">Liên Hệ</a>';
        }

        if ($price != 0 && $priceSale != 0) {
            return '<span><del>' . number_format($price, 0, ' ', '.') . ' <sup>đ</sup></del></span>
                    <span style="color: red">' . number_format($priceSale, 0, ' ', '.') . ' <sup>đ</sup></span>';
        }

        return '<span style="color: red">' . number_format($price, 0, ' ', '.') . ' <sup>đ</sup> </span>';
    }

    public static function fillter($array = [])
    {
        $linkDefault = explode('?', $_SERVER['REQUEST_URI']);
        $linkDefault = $linkDefault[0]; #Link mặc định

        #nếu không có yêu cầu
        if (count($array) == 0) return $_SERVER['REQUEST_URI'];
        
        $queryDefault = $_GET;
        unset($queryDefault['qMVC']);

        #Array gọp mảng
        $queryNew = array_merge($queryDefault, $array);

        /*   
            ['x' => 1, 'y' => 2]
            http_build_query => x=1&y=2
        */
        return $linkDefault . '?' . http_build_query($queryNew);
    }

    public static function getPriceFormat($price = 0, $type = 'vi')
    {
        return number_format($price, 0, ' ', '.');
    }
}