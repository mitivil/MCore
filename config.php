<?php

define("ROOT_PATH", __DIR__);

/**===== Фронт-зона ================================= */
define("VIEW_PATH", __DIR__ . '/View');
/**=================================================== */

/**===== Настройки MySql ======================== */
define('MYSQL_HOSTNAME', 'localhost');
define('MYSQL_USERNAME', 'root');
define('MYSQL_PASSWORD', 'MitiviliRaptariT12');
define('MYSQL_DATABASE', 'mcore');

/**===== Дополнительные библиотеки =================== */
define("LIBARY_PATH",  __DIR__ . '/Libary');

/**===== Ресурсы(Картинки, документы и тп..) ========= */
define("RESOURCE_PATH",  __DIR__ . '/Resource');

/**===== Ошибки ====================================== */
// Путь относительный от View.
// Страница 404. 
define("PAGE_404", '404.php');
// Страница ошибки ERROR.
define("PAGE_ERROR", 'error.php');

/**===== DEBUG ======================================= */
define("DEBUG", false);
