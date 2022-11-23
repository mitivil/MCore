<?php

namespace MCore\System;

use Error;
use MCore\System\Tools\MySql;

/**************************
 * Инструменты - Для быстрого применения при разработке. 
 */
class Tools
{
    /**
     * Запрос - В базу MySql. 
     *
     * @param string $query
     * @return array
     */
    public static function mySql(string $query): array
    {
        $result = [];

            $result = MySql::query($query);

        return  $result;
    }
    /**
     * Экранирует строку - Во избежания инъекций.
     *
     * @param string $string
     * @return string
     */
    public static function escape(string $string): string
    {
        return MySql::escape($string);;
    }
}
