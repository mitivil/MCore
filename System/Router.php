<?php

namespace MCORE\System;

use MCore\System\Loader;

class Router
{
    private static $url_reques = '';
    private static $url_redirect = '';
    private static $name_function = 'index';


    public static function routerRun(): Void
    {
        switch (TRUE) {
                // API.
            case isset($_GET['api']) && !empty($_GET['api']):
                Self::api();
                break;
                // USER-URL.
            default:
                Self::view();
                break;
        }
    }

    // API.
    private static function api(): Void
    {
        $apiPath = explode('/', str_replace('->', '/', $_GET['api']));
        $path_controller = CONTROLLER_PATH;
        $name_controller = $apiPath[count($apiPath) - 2];
        $function_controller = $apiPath[count($apiPath) - 1];
        for ($i = 0; $i < count($apiPath) - 1; $i++) {
            $path_controller .= '/' . $apiPath[$i];
        }
        // Направить.
        Self::direct($path_controller, $name_controller, $function_controller);
    }

    // VIEW.
    private static function view(): Void
    {
        $path_controller = CONTROLLER_PATH;
        $name_controller = '';
        Self::$url_reques = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        // Перебор роутеров.
        $files_router = scandir(ROUTER_PATH);
        foreach ($files_router as $file) {
            $file_rout = ROUTER_PATH . '/' . $file;
            if (file_exists($file_rout) && $file !== '.' && $file !== '..') {
                // Подключаем пользовательские роутеры.
                include_once($file_rout);
            }
            if (Self::$url_redirect !== '') break;
        }

        // Позиция роутера.
        switch (ROUTE_POSITION) {
            case 'CNC': // ЧПУ.           
                $path_controller .= str_replace('->', '/', Self::$url_reques);
                $split_controll = explode('/', parse_url(Self::$url_reques, PHP_URL_PATH));
                $name_controller =  $split_controll[count($split_controll) - 1];
                break;

            case 'ROUTE': // МАРШУРТ.                      
                $path_controller .=  '/' . str_replace('->', '/', Self::$url_redirect);
                $split_controll = explode('/', parse_url(Self::$url_redirect, PHP_URL_PATH));
                $name_controller = $split_controll[count($split_controll) - 1];
                break;

            case 'AUTO': // МАРШРУТ и ЧПУ.
                if (Self::$url_redirect !== '') {
                    $path_controller .=  '/' . str_replace('->', '/', Self::$url_redirect);
                    $split_controll = explode('/', parse_url(Self::$url_redirect, PHP_URL_PATH));
                    $name_controller = $split_controll[count($split_controll) - 1];
                } else {
                    $path_controller .= str_replace('->', '/', Self::$url_reques);
                    $split_controll = explode('/', parse_url(Self::$url_reques, PHP_URL_PATH));
                    $name_controller =  $split_controll[count($split_controll) - 1];
                }
                break;
        }


        // Выполнить маршрут.
        Self::direct($path_controller, $name_controller, Self::$name_function);
    }

    // Направить.
    private static function direct(string $path_controller, string $name_controller, string $function_controller = 'index'): Void
    {
        try {
            if (file_exists($path_controller . '.php')) {
                // Загружаем.
                include_once($path_controller . '.php');
                $obj_controller = new $name_controller;
                $obj_controller->$function_controller();
            } else {
                // 404.
                Loader::goView(PAGE_404);
            }
        } catch (\Throwable $th) {
            // 404.
            Loader::goView(PAGE_404);
        }
    }

    // Redirect-Uri.
    public static function redirectUri(string $url, string $path_controller, string $name_function = 'index'): void
    {
        // Если перенаправление найдено.
        if (Self::$url_reques == $url) {
            Self::$url_redirect = $path_controller;
            Self::$name_function = $name_function;
        }
    }
}
