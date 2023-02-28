<?php

namespace MCore\System\Tools;

use MCore\System\Tools;

class Pagination
{
    public static function getPagination($total_page, $current_page)
    {
        $start_next = true;
        $end_next = true;

        $start_page = $current_page;
        $end_page = $current_page;
        // Ищем минимальную страницу.
        $trig = 0;
        while (true) {
            if ($start_page <= 1) { // Отсечка если нельзя пролистать страницы.
                $start_next = false;
                break;
            }
            if ($trig > 2 ) {
                break;
            }

            $start_page--;
            $trig++;
        }
        // Ищем максимальную страницу.
        $trig = 0;
        while (true) {
            if ($end_page  >= $total_page) { // Отсечка если нельзя пролистать страницы.
                $end_next = false;
                break;
            }
            if ($trig > 2) { 
                break;
            }
            $end_page++;
            $trig++;
        }

        $area_page = [];
        for ($i = $start_page; $i <= $end_page; $i++) {
            $area_page[] = $i;
        }

        $result = [
            'max_page'     => $total_page,
            'current_page' => $current_page,
            'area_page'    => $area_page,
            'start_next'   => $start_next,
            'end_next'     => $end_next,
        ];

        return $result;
    }
}
