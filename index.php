<?php

require_once('const.php');
require_once('model.php');
require_once('controllers/AbstractController.php');
require_once('controllers/HomeController.php');
require_once('controllers/AddController.php');
require_once('controllers/AdminController.php');
require_once('controllers/NotFoundController.php');
require_once('controllers/AliasController.php');

$config = require_once('config.php');
$routes = require_once('routes.php');

$request_uri = $_SERVER['REQUEST_URI'];
$controller_class = array_key_exists($request_uri, $routes)
    ? $routes[$request_uri]
    : AliasController::class;
$controller = new $controller_class($config);
$controller->exec();
