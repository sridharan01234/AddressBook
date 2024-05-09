<?php
require "router/Router.php";
$path = $_SERVER['REQUEST_URI'];
if (strpos($path, '?')) {
    $path = substr($path, 0, strpos($path, '?'));
}

$router = new Router;

$router->add("/", array('Controller' => 'AuthController', 'action' => 'index'));
$router->add("/register", array('Controller' => 'AuthController', 'action' => 'index'));
$router->add("/login", array('Controller' => 'AuthController', 'action' => 'index'));

$param = $router->searchPath($path);
if (!$param) {
    require_once './view/PageNotFound.php';
    exit;
}

$controller = $param['Controller'];
$action = $param['action'];

require sprintf("controller/%s.php",$controller);

$controller_object = new $controller(substr($path,1,strlen($path)-1));
$controller_object->$action();