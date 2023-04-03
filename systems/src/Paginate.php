<?php

namespace System\Src;

class Paginate
{
    public static function view($sumRow = 0, $limit = 2, $page = 1, $url = '')
    {
        $numberPage = ceil($sumRow / $limit);

        $html = '<ul class="pagination" style="justify-content:center">';
        if ($page > 1) {
            $html .= '<li class="page-item"><a class="page-link" href="'.$url.'?page=1" >Đầu</a></li>';
            $html .= '<li class="page-item"><a class="page-link" href="'.$url.'?page='. ($page - 1) .'">Lùi</a></li>';
        }

        $start = $page >= 3 ? ($page - 2) : 1;
        $end = ($numberPage - $page) < 2 ? $numberPage : ($page + 2);

        for ($i = $start; $i <= $end; $i++) {
            $html .= '<li class="page-item"><a class="page-link" href="'.$url.'?page='. $i .'" 
                        style="' .( $page == $i ? 'color: red':''). '" >'. $i .'</a></li>';
        }

        if ($page < $numberPage) {
            $html .= '<li class="page-item"><a class="page-link" href="'.$url.'?page='. ($page + 1) .'" >Tiến</a></li>';
            $html .= '<li class="page-item"><a class="page-link" href="'.$url.'?page='. $numberPage .'">Cuối</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }
}