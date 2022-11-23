<?php

namespace MCORE\System;

use MCore\System\Loader;
use MCore\System\Engine;

/*********
 * Контрольный пункт микро-фраемворка (Mcore)
 */
class Mcore
{
    /**
     * Запуск движка
     *
     * @return void
     */
    public static function runEngine()
    {
        /***** Запускаем основные части движка *****/
        Engine::runConfig();
        Engine::runLogger();
    }

    public static function router()
    {
        Engine::runRouter();
    }

    public static function loader()
    {
        Engine::runRouter();
    }
}
