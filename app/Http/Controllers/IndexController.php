<?php

namespace App\Http\Controllers;

use App\RMVC\Route\Route;
use App\RMVC\View\View;
use League\Plates\Engine;

class IndexController extends Controller
{
    public function __invoke()
    {
        return View::view2('index.index');
    }
}