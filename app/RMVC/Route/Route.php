<?php

namespace App\RMVC\Route;

class Route
{
    private static array $routesGet = [];
    private static array $routesPost = [];
    private static array $routesPatch = [];
    private static array $routesDelete = [];

    private static string $defaultAction = '__invoke';

    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }
    public static function getRoutesPost(): array
    {
        return self::$routesPost;
    }
    public static function getRoutesPatch(): array
    {
        return self::$routesPatch;
    }
    public static function getRoutesDelete(): array
    {
        return self::$routesDelete;
    }

    public static function get(string $route, array $controller): RouteConfiguration
    {
        if (!isset($controller[1])) $controller[1] = Route::$defaultAction;

        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesGet[] = $routeConfiguration;

        return $routeConfiguration;
    }

    public static function post(string $route, array $controller): RouteConfiguration
    {
        if (!isset($controller[1])) $controller[1] = Route::$defaultAction;

        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesPost[] = $routeConfiguration;

        return $routeConfiguration;
    }

    public static function patch(string $route, array $controller): RouteConfiguration
    {
        if (!isset($controller[1])) $controller[1] = Route::$defaultAction;

        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesPatch[] = $routeConfiguration;

        return $routeConfiguration;
    }

    public static function delete(string $route, array $controller): RouteConfiguration
    {
        if (!isset($controller[1])) $controller[1] = Route::$defaultAction;

        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesDelete[] = $routeConfiguration;

        return $routeConfiguration;
    }

    public static function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }

}