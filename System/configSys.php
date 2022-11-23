<?php

/**===== Логика ===================================== */
// Контроллёр-зона.
define("CONTROLLER_PATH", ROOT_PATH . '/Logic/Controller');
// Модель-зона.
define("MODEL_PATH", ROOT_PATH . '/Logic/Model');
/**=================================================== */

/**===== Router-Маршрутизация ======================== */
define("ROUTER_PATH", ROOT_PATH . '/Router');
/**=================================================== */

/**===== Позиция-Роутер =================== */
// Принимает 3-Аргумента:  1.(CNC-Только ЧПУ)  2.(ROUTE-Только Маршрут) 3.(AUTO-Маршрут и ЧПУ)
define("ROUTE_POSITION", 'AUTO');

/**===== Логирование =================== */
// Путь до файла-Log.
define("LOGGER_PATH",  ROOT_PATH . '/System/log/Error.log');
// Размер файла-log.
define("LOGGER_SIZE", 1); // МБ.
// Уровень записывающих ошибок. 
define("LOGGER_ERROR_LEVEL", E_ALL); // Читать: (https://www.php.net/manual/en/errorfunc.constants.php)
