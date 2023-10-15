<?php

namespace App\RMVC\View;

use App\Database\Session;
use League\Plates\Engine;

class View
{
    private static $path;
    private static ?array $data;

    public static function view(string $str, array $data = []) //: string
    {
        self::$data = $data;

        $path = str_replace('public', 'resources/views/', $_SERVER['DOCUMENT_ROOT']);
        self::$path = $path . str_replace('.', '/', $str) . '.php';

        return self::getContent();
    }

    private static function getContent() : string
    {
        extract(self::$data);

        ob_start();
            include self::$path;
            $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    /**
    * PlatesPHP Template
    */
    public static function view2(string $str, array $data = []): string
    {
        $path = str_replace('public', 'resources/views/', $_SERVER['DOCUMENT_ROOT']);
        $templates = new Engine($path);

        $templates->addData(['timeToExpired' => Session::getTimeToExpired('USER_AUTH')]);
        $templates->addData(['USER_AUTH' => Session::getSessionVar('USER_AUTH')]);
        $templates->addData(['data' => $data]);

        $path2 = str_replace('.', '/', $str);
        return $templates->render($path2);
    }
}