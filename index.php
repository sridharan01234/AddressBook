<?php
require "router/Route.php";
$path = $_SERVER['REQUEST_URI'];
if (strpos($path, '?')) {
    $path = substr($path, 0, strpos($path, '?'));
}

$router = new Router;

$router->add("/", array('Controller' => 'RegisterController', 'action' => 'index'));
$router->add("/register", array('Controller' => 'RegisterController', 'action' => 'index'));
$router->add("/login", array('Controller' => 'LoginController', 'action' => 'index'));

$param = $router->searchPath($path);
if (!$param) {
    echo 'Page Not Found';
    exit;
}

$controller = $param['Controller'];
$action = $param['action'];

require "controller/$controller.php";

$controller_object = new $controller();
$controller_object->$action();