<?php

namespace App\Helpers;

use App\Models\MenuModel;

class ViewComposer
{
    public static function getDataMenuIsActive()
    {
        return (new MenuModel)->getAllMenuIsActive();
    }


    public static function loadViewMenuTop($menus = [], $parentId = 0, $class = 'sub-menu')
    {
        $html = '';

        foreach ($menus as $key => $menu) {
            if ($menu['parent_id'] == $parentId) {
                $html .= '<li><a href="/danh-muc/' . \System\Src\Str::slug($menu['title']) . '-id' . $menu['id'] . '.html">
                        ' . $menu['title'] . '</a>';

                #Kiểm tra con
                if (self::isChild($menus, $menu['id'])) {
                    $html .= '<ul class="' . $class . '">';
                    $html .= self::loadViewMenuTop($menus, $menu['id'], $class);
                    $html .= '</ul>';

                    if ($class == 'sub-menu-m') {
                        $html .= '<span class="arrow-main-menu-m">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>';
                    }
                }

                $html .= '</li>';
            }
        }

        return $html;
    }

    public static function isChild($menus, $id)
    {
        $isChild = false;
        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $id) {
                $isChild = true;
                break;
            }
        }

        return $isChild;
    }
}