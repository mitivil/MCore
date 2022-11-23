<?php

use MCore\System\Logger;

function errorHandler(int $errNo, string $errMsg, string $file, int $line)
{
    // Запись ошибко в лог-файл.
    if ($errNo <= LOGGER_ERROR_LEVEL) {
        $errorMsg = date('Y-m-d H:i:s') . ":   Сообщение-> [$errMsg],  Файл-> [$file], Строка-> [$line];" . PHP_EOL;
        Logger::writeLog($errorMsg);
    }
}
set_error_handler('errorHandler');
