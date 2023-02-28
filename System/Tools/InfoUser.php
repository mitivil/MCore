<?php

namespace MCore\System\Tools;

use MCore\System\Tools;

class InfoUser
{
    public static function getInfoCookie()
    {
        $infoUser = [];
        if (isset($_COOKIE['dataUser'])) {
            $infoUser =  Tools::mySql("SELECT * FROM users WHERE password = '" . Tools::escape($_COOKIE['dataUser']) . "'    ");
        }
        if (empty($infoUser)) {
            $infoUser[0]['role'] = 'Гость'; // Обнуляем.
        }
        $infoUser[0]['group'] = Self::getGroupUser($infoUser[0]['role']); // Получаем роль-группу пользователя.
        return $infoUser;
    }

    public static function getInfoTelephone($telephone)
    {
        $infoUser = [];
        if (isset($_COOKIE['dataUser'])) {
            $infoUser =  Tools::mySql("SELECT * FROM users WHERE telephone = '" . Tools::escape($telephone) . "'    ");
        }
        if (empty($infoUser)) {
            $infoUser[0]['role'] = 'Гость'; // Обнуляем.
        }
        $infoUser[0]['group'] = Self::getGroupUser($infoUser[0]['role']); // Получаем роль-группу пользователя.
        return $infoUser;
    }

    public static function getInfoID($user_id)
    {
        $infoUser = [];
        $infoUser =  Tools::mySql("SELECT * FROM users WHERE id = '" . $user_id . "'    ");
        if (empty($infoUser)) {
            $infoUser[0]['role'] = 'Гость'; // Обнуляем.
        }
        $infoUser[0]['group'] = Self::getGroupUser($infoUser[0]['role']); // Получаем роль-группу пользователя.
        return $infoUser;
    }

    public static function getInfoUserMD5($password_MD5)
    {
        $infoUser = [];
        if ($password_MD5) {
            $infoUser =  Tools::mySql("SELECT * FROM users WHERE password = '" . Tools::escape($password_MD5) . "'    ");
        }
        if (empty($infoUser)) {
            $infoUser[0]['role'] = 'Гость'; // Обнуляем.
        }
        $infoUser[0]['group'] = Self::getGroupUser($infoUser[0]['role']); // Получаем роль-группу пользователя.
        return  $infoUser;
    }

    // Получить группу пользователя.
    private static function getGroupUser($role): string
    {
        $result_group = '';
        switch ($role) {
            case 'Гость':
                $result_group = 'group-1';
                break;
            case 'Новичок':
                $result_group = 'group-2';
                break;
            case 'Бывалый':
                $result_group = 'group-3';
                break;
            case 'Свой':
                $result_group = 'group-4';
                break;
            case 'Родной':
                $result_group = 'group-5';
                break;
            case 'Администратор':
                $result_group = 'group-6';
                break;
        }
        return $result_group;
    }
}
