<?php

namespace MCore\System\Tools;

use MCore\System\Logger;


class MySql
{
    private static $session_sql;

    private static function connect(): void
    {
        if (empty(Self::$session_sql)) {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            Self::$session_sql =  mysqli_connect(MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
            mysqli_set_charset(Self::$session_sql, "utf8");
        }
    }

    public static function query(string $query): array
    {
        $result = [];
        try {
            Self::connect();
            $sql = Self::$session_sql->query($query);
            if (isset($sql->num_rows)) {
                $result = $sql->fetch_all(MYSQLI_ASSOC);
            }
        } catch (\Throwable $th) {
            Logger::writeLog(Self::$session_sql->error);
        }
        return $result;
    }

    public static function escape(string $string): string
    {
        Self::connect();
        return Self::$session_sql->real_escape_string($string);
    }

    public static function lastID(): string
    {
        $lastID = Self::$session_sql->insert_id;
        return $lastID;
    }
}
