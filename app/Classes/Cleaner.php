<?php

namespace App\Classes;

trait Cleaner
{
    public function checkSpecialChars(&$array) {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $this->checkSpecialChars($value);
            } else {
                $value = htmlspecialchars($value, ENT_QUOTES);
            }
        }
    }

    public function cleanBadChars(string $str): string
    {
        return preg_replace('/[\'"<> ]/', '', $str);
        //return preg_replace('/[^\w\d]+/', '', $str);
    }

    protected static function cleanSlashes($str): string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $str);
    }
}