<?php

spl_autoload_register(function ($class_name) {
    include "controllers/$class_name.php";
});

require_once('const.php');
require_once('model.php');

$config = require_once('config.php');
$routes = require_once('routes.php');

$request_uri = $_SERVER['REQUEST_URI'];
$controller_class = array_key_exists($request_uri, $routes)
    ? $routes[$request_uri]
    : AliasController::class;
$controller = new $controller_class($config);
$controller->exec();
