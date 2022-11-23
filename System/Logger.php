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
    }

    error_log($errorMsg, 3, $logPath);

    // Отладка.
    if (!isset($_GET['api']) && empty($_GET['api'])) {
      if (DEBUG === false) {
        ini_set("display_errors", 0);
        Loader::goView(PAGE_ERROR);
      } else {
        echo $errorMsg;
        ini_set("display_errors", 1);
      }

    }else{
      echo "Ошибка ";
    }
  }
}
