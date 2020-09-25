<?php

spl_autoload_register(function ($class_name) {
    if (stripos($class_name, 'Controller')) {
        include "controllers/$class_name.php";
    } elseif (stripos($class_name, 'Model')) {
        include "models/$class_name.php";
    }
});

require_once('const.php');

$config = require_once('config.php');
$routes = require_once('routes.php');

$request_uri = $_SERVER['REQUEST_URI'];
$controller_class = array_key_exists($request_uri, $routes)
    ? $routes[$request_uri]
    : AliasController::class;
$controller = new $controller_class(new AliasModel($config));
$controller->exec();
