<?php

use MCore\System\Logger;  
use MCore\System\Loader; // Загрузчик (Model, View).

/**
 * LogicHome - Микро-Логика домашней страницы.
 */
class ControllerHome
{
    // Базовый метод. 
    public function index()
    {
        // Загружаем модель.    
        $modelHome = Loader::model('ModelHome');


        // Формируем 
        $data = [
            'header_file'   => VIEW_PATH . '/Common/header.php',
            'content_file'  => VIEW_PATH . '/Page/home.php',
            'footer_file'   => VIEW_PATH . '/Common/footer.php',
        ];

        // Выводим данные на макет. 
        Loader::goView('index.php', $data);
    }

    public function apiRequestTest()
    {
        // Загружаем модель.
        $modelHome = Loader::model('ModelHome');
        $result = $modelHome->getUser();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}
