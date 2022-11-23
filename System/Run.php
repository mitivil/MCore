<?php

namespace Mcore\System;

use MCore\System\Router;

class Run
{
    public static function config()
    {
        require_once('config.php');
        require_once('System/configSys.php');
    }

    public static function logger()
    {
        require_once('System/LogHandler.php');
    }

    public static function router()
    {
        Router::routerRun();
    }
}
