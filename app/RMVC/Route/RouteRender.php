<?php

namespace App\RMVC\Route;

class RouteRender
{
    private string $controller;
    private string $action;
    private ?array $paramRequestMap;

    public function __construct(string $controller, string $action, ?array $paramRequestMap = [])
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->paramRequestMap = $paramRequestMap;
    }

    public function render()
    {
        $className = $this->controller;
        $action = $this->action ?? '__invoke';

        echo (new $className)->$action(...$this->paramRequestMap);
    }
}