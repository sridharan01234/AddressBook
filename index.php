<?php

require_once "./helper/SessionHelper.php";
require_once "router/Router.php";

$path = strtok($_SERVER['REQUEST_URI'], '?');

$router = new Router;

$router->add("/", ['Controller' => 'AuthController', 'action' => 'login']);
$router->add("/register", ['Controller' => 'AuthController', 'action' => 'register']);
$router->add("/login", ['Controller' => 'AuthController', 'action' => 'login']);
$router->add("/listContacts", ['Controller' => 'ContactsController', 'action' => 'listContacts']);
$router->add("/logout", ['Controller' => 'AuthController', 'action' => 'logout'], );
$router->add("/addContact", ['Controller' => 'ContactsController', 'action' => 'addContact']);
$router->add("/deleteContact", ['Controller' => 'ContactsController', 'action' => 'deleteContact']);
$router->add("/getCounties", ['Controller' => 'ContactsController', 'action' => 'getCounties']);
$router->add("/getStates", ['Controller' => 'ContactsController', 'action' => 'getStates']);


$param = $router->searchPath($path);
if (!$param) {
    require_once './view/pageNotFound.php';
    exit;
}

if (($path == '/login' || $path == '/') && isset($_SESSION['user_id'])) {
    header('Location: /listContacts');
    exit;
}

if (!isset($_SESSION['user_id']) && !($path == '/login' || $path == '/register')) {
    header('Location: /login');
    exit;
}
$controller = $param['Controller'];
$action = $param['action'];

require_once sprintf("controller/%s.php", $controller);

$controller_object = new $controller($path);
$controller_object->$action();