<?php

namespace MCore\System;

use MCore\System\Run;

/****************************************
 * Engine - Двигатель низкоуровневых процессов.
 */
class Engine
{
    // Запуск конфигураций.
    public static function runConfig()
    {
        Run::config();
    }

    // Запуск логера.
    public static function runLogger()
    {
        Run::logger();
    }

    // Запуск маршрутизации.
    public static function runRouter()
    {
        Run::router();
    }

    // Загрузка Микро-Логики.
    private function loadLogic($path, $method = '')
    {
        include_once($path);
        $Myclass = str_replace('.php', '', pathinfo($path, PATHINFO_BASENAME));
        $loadClass = new $Myclass();
        return $loadClass->$method();
    }


    // // Загрузить страницу.
    // private function loadView($path, $data = null, $file_path = null)
    // {
    //     if (file_exists($path)) {
    //         include_once(VIEW_INDEX_PATH);
    //     } else {
    //         include_once(PAGE_404);
    //     }

    //     //         echo '<pre>';
    //     // print_r($path);
    //     // echo '<pre>';
    //     // exit;

    //     include_once(VIEW_INDEX_PATH);
    // }


    // Подключим настройки.
    private static function includeSetting()
    {
        if (file_exists('../config.php')) {
            require_once('config.php');
        }
    }
}
