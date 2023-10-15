<?php

namespace App\Classes;

class JSON
{
    public static function toJson(array $array): string
    {
        header('Content-Type: application/json; charset=utf-8');
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }

    public static function toJSONSuccess($message, $data, $redirectURL = null): string
    {
        $array = [
            "status" => 'Success',
            "message" => $message,
            "data" => $data
        ];

        if (isset($redirectURL)) $array['url'] = $redirectURL;

        return self::toJson($array);
    }

    public static function toJSONError($message, $data, $elementToShowError = null): string
    {
        $array = [
            "status" => 'Error',
            "message" => $message,
            "data" => $data,
        ];

        if (isset($elementToShowError)) $array['elementID'] = $elementToShowError;

        return self::toJson($array);
    }
}