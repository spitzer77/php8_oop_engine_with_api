<?php

namespace App\RMVC\Route;

use App\Classes\Cleaner;
use App\Database\Session;

class RouteDispatcher
{
    use Cleaner;

    private RouteConfiguration $routeConfiguration;
    private string $requestUri = '/';
    private array $paramMap = [];
    private array $paramRequestMap = [];


    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }
    public function process()
    {
        $this->setCleanRequestAndRouteUri();

        $this->setExistParamPosition();

        $this->makeRegexRequest();

        $this->compareRouteWithUriPatternToRun();

    }
    private function setCleanRequestAndRouteUri(): void
    {
        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requestUri = $this->cleanSlashes($_SERVER['REQUEST_URI']);
            $this->routeConfiguration->route = $this->cleanSlashes($this->routeConfiguration->route);
        }
    }

    private function setExistParamPosition(): void
    {
        $routeArray = explode('/', $this->routeConfiguration->route);

        foreach ($routeArray as $paramKey => $param) {
            if (preg_match('/{.*}/', $param)) {
                $this->paramMap[$paramKey] = preg_replace('/(^{)|(}$)/', '', $param);
            }
        }
    }

    private function makeRegexRequest()
    {
        $requestUriArray = explode('/', $this->requestUri);

        $requestUriArray = array_map(function ($url) {
            //return $url;
            return $this->cleanBadChars($url);

        }, $requestUriArray);

        foreach ($this->paramMap as $paramKey => $param) {

            if (!isset($requestUriArray[$paramKey])) {
                //return;
                break;
            }

            $this->paramRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = '{.*}';
        }

        $this->requestUri = implode('/', $requestUriArray);

        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    private function compareRouteWithUriPatternToRun()
    {
        $pattern = "^" . $this->requestUri;
        if (count(explode('/', $this->requestUri)) === 1) $pattern .= "$";

        if (preg_match("/$pattern/", $this->routeConfiguration->route)) {
            $this->render();
        }
    }

    private function render()
    {
        if ($this->routeConfiguration->middleware == 'auth' && SESSION::getSessionVar('USER_AUTH') === false) {
            //header('HTTP/1.1 401 Unauthorized');
            Route::redirect('/user/login');
            die();
        }

        (new RouteRender($this->routeConfiguration->controller,
            $this->routeConfiguration->action,
            $this->paramRequestMap))
            ->render();
        die();
    }
}
