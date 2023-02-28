<?php

namespace MCore\System;

/************
 * Загрузчик.
 */
class Loader
{
    /**
     * Загрузка библиотек.
     *
     * @param [string] $file_path - Относительный путь до файла (Библиотеки), заменяйте слэш(Директории) на следующий символ '->'
     * @return [string] $result - Возвращает полный путь к файлу подключаемой библиотеки, если существует.
     */
    public static function libary(string $file_path): string
    {
        $result = '';
        $full_path = LIBARY_PATH . '/' . str_replace('->', '/', $file_path);
        if (file_exists($full_path)) {
            $result = $full_path;
        }
        return $result;
    }
    /**
     * Загрузка контроллёра. 
     *
     * @param [string] $controller_path_class - Относительный путь до файла (Контроллера).
     * 
     * Примечание! Название файла должно соответствовать названию класса, заменяйте слэш(Директории) на следующий символ '->' 
     * 
     * Пример подключения файла и класса: "Admin->user->controllerUser"
     * @return void
     */
    public static function controller(string $controller_path_class): object
    {
        $found_class = [];
        $split_path = explode('->', $controller_path_class);
        $classAndFile = $split_path[count($split_path) - 1];
        $full_path = CONTROLLER_PATH . '/' . str_replace('->', '/', $controller_path_class) . '.php';

        if (file_exists($full_path)) {
            include_once($full_path);
            $found_class = new $classAndFile();
        }
        return $found_class;
    }

    /**
     * Загрузка модели. 
     *
     * @param [string] $model_path_class - Относительный путь до файла (Модели).
     * 
     * Примечание! Название файла должно соответствовать названию класса, заменяйте слэш(Директории) на следующий символ '->' 
     * 
     * Пример подключения файла и класса: "Admin->user->modelUser"
     * @return void
     */
    public static function model(string $model_path_class): object
    {
        $found_class = [];
        $split_path = explode('->', $model_path_class);
        $classAndFile = $split_path[count($split_path) - 1];
        $full_path = MODEL_PATH . '/' . str_replace('->', '/', $model_path_class) . '.php';
        include_once($full_path);
        $found_class = new $classAndFile();
        return $found_class;
    }

    /**
     * Перейти к просмотру.
     *
     * @param string $goToFile - Укажите файл для запуска (index, 404, error), файлы подключаются в View.
     * @param array $data      - Передайте массив данных для дальнейшей работы.
     * @return void
     */
    public static function goView(string $goToFile = 'index.php', array $data = []): void
    {
        $countData = count($data);
        $nameArray = array_keys($data);
        for ($i = 0; $i < $countData; $i++) {
            ${$nameArray[$i]} = $data[$nameArray[$i]];
        }
        unset($data, $i, $countData, $nameArray);
        include_once(VIEW_PATH . '/' . $goToFile);
    }
}
