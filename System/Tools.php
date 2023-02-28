<?php

namespace MCore\System;

use Error;
use MCore\System\Tools\MySql;
use MCore\System\Tools\InfoUser;
use MCore\System\Tools\TImagick;
use MCore\System\Tools\Pagination;

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
    public static function mySql(string $query)
    {
        $result = [];

        $result = MySql::query($query);
        if (!empty($result)) {
            return  $result;
        }
    }
    /**
     * Получить последний ID добавленный в БД - MySql. 
     *
     * @return array
     */
    public static function mySql_lastID()
    {
        $result = [];

        $result = MySql::lastID();
        if (!empty($result)) {
            return  $result;
        }
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

    /**
     * Узнать информацию об зарегистрированном пользователе, данные берёт из куки.
     *
     * @return array - Вернёт Array либо Null
     */
    public static function infoUserCookie(): array
    {
        $infoUser = InfoUser::getInfoCookie()[0];
        Self::updateDateVisitUser($infoUser); // Обновляем визит пользователя.
        return $infoUser;
    }

    /**
     * Узнать информацию об зарегистрированном пользователе, По телефону.
     *
     * @param string $telephone - (Указать телефон пользователя).
     * @return array - Вернёт Array либо Null
     */
    public static function infoUserTelephone($telephone): array
    {
        $infoUser = InfoUser::getInfoTelephone($telephone)[0];
        Self::updateDateVisitUser($infoUser); // Обновляем визит пользователя.
        return $infoUser;
    }

    /**
     * Узнать информацию об зарегистрированном пользователе, по паролю MD5-"Телефон+Пароль".
     *
     * @param string $password_MD5 - (Указать пароль MD5-"Телефон+Пароль" пользователя).
     * @return array - Вернёт Array либо Null
     */
    public static function infoUserMD5($password_MD5): array
    {
        $infoUser = InfoUser::getInfoUserMD5($password_MD5)[0];
        Self::updateDateVisitUser($infoUser); // Обновляем визит пользователя.
        return $infoUser;
    }

    /**
     * Узнать информацию об зарегистрированном пользователе, по ID номеру".
     *
     * @param string $user_id - (Указать ID пользователя).
     * @return array - Вернёт Array либо Null
     */
    public static function infoUserID($user_id): array
    {
        $infoUser = InfoUser::getInfoID($user_id)[0];
        Self::updateDateVisitUser($infoUser); // Обновляем визит пользователя.
        return $infoUser;
    }


    // Обновление даты визита пользователя на сайт.
    private static function updateDateVisitUser($infoUser)
    {
        if ($infoUser['role'] !== 'Гость') {
            Self::mySql("UPDATE users SET vizit_date = NOW()  WHERE  id = '" . $infoUser['id'] . "' ");
        }
    }





    /***********************************************************************************
     * Инструменты --- Imagick
     ***********************************************************************************/

    /************************************
     * Установить качество фотографии.
     * 
     * @param $path_file - Путь до фотки.
     * @param $quality   - Качество фото.
     * @return void
     */
    public static function imgQuality($path_file, $quality)
    {
        TImagick::quality($path_file, $quality);
    }

    public static function imgResize($path_file, $width)
    {
        TImagick::resize($path_file, $width);
    }




    /**
     * ПАГИНАЦИЯ ====================================
     *
     * @param [type] $total_page - Общее колличество страниц.
     * @param [type] $current_page - Текущая страница.
     * @return array - Возвращаем массив пагинации.
     */
    public static function pagination($total_page, $current_page)
    {
        return  Pagination::getPagination($total_page, $current_page);
    }
}
