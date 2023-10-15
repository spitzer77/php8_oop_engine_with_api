<?php

namespace App\Classes;

class Hash
{
    public static function bcrypt(string $password): bool | string
    {
        return (!empty($password) ? password_hash($password, PASSWORD_BCRYPT) : false);
    }
}