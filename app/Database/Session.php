<?php

namespace App\Database;

class Session
{
    public static function setSessionVar($name, $value, $lifetime): bool
    {
        $array = [
            'value' => $value,
            'expire' => time() + $lifetime,
        ];

        $_SESSION[$name] = $array;

        return true;
    }

    public static function getSessionVar($name): mixed
    {
        if (isset($_SESSION[$name]) && $_SESSION[$name]['expire'] >= time())
        {
            return $_SESSION[$name]['value'];
        }
        return false;
    }

    public static function getTimeToExpired($name): string | bool
    {
        if (isset($_SESSION[$name])) {
        $toExpired = $_SESSION[$name]['expire'] - time();
        return ($toExpired > 0 ? $toExpired : false);
        }
        else return false;
    }

}