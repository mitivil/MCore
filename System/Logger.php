<?php

namespace MCore\System;

use MCore\System\Loader;

/**
 * Логгер - Отлавливайте и записывайте в журнал !
 */
class Logger
{
  public static function writeLog($errorMsg)
  {
    $logPath = LOGGER_PATH;

    // Чистим файла.
    if (file_exists($logPath)) {
      $sizeFile = round(filesize($logPath) / 1024 / 1024);
      if ((int)$sizeFile >  (int)LOGGER_SIZE) {
        unlink($logPath);
      }
    } else {
      Self::createPathLog($logPath); // Создадим путь до лог файла.
    }

    error_log($errorMsg, 3, $logPath);

    // Отладка > (Если истина тогда выводим ошибки на экран).
    if (!isset($_GET['api']) && empty($_GET['api'])) {
      if (DEBUG === false) {
        ini_set("display_errors", 0);
        Loader::goView(PAGE_ERROR);
      } else {
        echo $errorMsg;
        ini_set("display_errors", 1);
      }
    } else {
      if (DEBUG === false) {
        Loader::goView(PAGE_ERROR);
      }   
    }
  }

  private static function createPathLog($logPath)
  {
    $logPathArray = explode('/', str_replace($_SERVER['DOCUMENT_ROOT'], '', $logPath));
    $logPathForming =  $_SERVER['DOCUMENT_ROOT'] . '/';

    for ($i = 0; $i < count($logPathArray) - 1; $i++) {
      if ($logPathArray[$i] !== '') {
        $logPathForming .= $logPathArray[$i] . '/';
        if (!is_dir($logPathForming)) {
          // Создаём директорию если отсуствует.
          mkdir($logPathForming, 0755, true);
        }
      }
    }
  }
}
