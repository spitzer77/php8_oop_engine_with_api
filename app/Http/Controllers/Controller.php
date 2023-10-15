<?php

namespace App\Http\Controllers;
use App\Database\Session;

class Controller
{
    protected function authId(){
        return Session::getSessionVar('USER_AUTH')['id'];
    }
    public function currentTimestamp()
    {
        return date('Y-m-d H:i:s');
    }

    protected function arrayToIdKey(array $rows, string $field) {
        $result = array_reduce($rows, function($array, $item) use($field) {
            $array[$item[$field]] = $item;
            return $array;
        }, []);

        return $result;
    }

}