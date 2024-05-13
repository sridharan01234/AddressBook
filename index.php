<?php
require_once "router/Router.php";
$path = strtok($_SERVER['REQUEST_URI'], '?');

$router = new Router;

$router->add("/", ['Controller' => 'AuthController', 'action' => 'login']);
$router->add("/register", ['Controller' => 'AuthController', 'action' => 'register']);
$router->add("/login", ['Controller' => 'AuthController', 'action' => 'login']);
$router->add("/listContacts", ['Controller' => 'ContactsController', 'action' => 'listContacts']);
$router->add("/logout", ['Controller'=> 'AuthController', 'action' => 'logout'],);

$param = $router->searchPath($path);
if (!$param) {
    require_once './view/pageNotFound.php';
    exit;
}

$controller = $param['Controller'];
$action = $param['action'];

require_once sprintf("controller/%s.php", $controller);

$controller_object = new $controller($path);
$controller_object->$action();