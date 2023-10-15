<?php

namespace App\RMVC;

use App\Classes\Cleaner;
use App\RMVC\Route\Route;
use App\RMVC\Route\RouteDispatcher;
use App\RMVC\Route\RouteRender;

class App
{
    use Cleaner;
    public static function run()
    {
        $requestMethodName = $_POST['REQUEST_METHOD'] ?? $_SERVER['REQUEST_METHOD'];

        $requestMethod = ucfirst(strtolower($requestMethodName));
        $methodName = 'getRoutes' . $requestMethod;

        if ($_SERVER['REQUEST_URI'] == '/') {
            foreach (Route::$methodName() as $routeConfiguration) {
                if ($routeConfiguration->route == '/') {
                    (new RouteRender($routeConfiguration->controller, $routeConfiguration->action))->render();
                    die();
                }
                else {
                    header("HTTP/1.1 404 Not Found");
                }
            }
        } else {

            foreach (Route::$methodName() as $items) {
                $cleanRoute = self::cleanSlashes($items->route);
                if ($cleanRoute)
                    preg_match('/^(\w+)(\/|$)/', $cleanRoute, $match);
                    if (!empty($match[1])) $matches[$match[1]] = $match[1];
            }

            $models = array_values($matches);
            preg_match('/^(\w+)(\/|$)/', self::cleanSlashes($_SERVER['REQUEST_URI']), $match);

            if (!in_array($match[1], $models)) {
                //header("HTTP/1.1 404 Not Found");
                header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                die();
            };

            foreach (Route::$methodName() as $routeConfiguration) {
                $routeDispatcher = new RouteDispatcher($routeConfiguration);
                $routeDispatcher->process();
            }
        }
    }
}