<?php


use App\RMVC\App as App;

session_start();

date_default_timezone_set('Europe/Kiev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../routes/web.php';

App::run();




