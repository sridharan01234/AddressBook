<?php

require_once "router/Router.php";
require_once "helper/SessionHelper.php";

$requestUri = strtok($_SERVER['REQUEST_URI'], '?');

$route = new Router;

$route->add("/", ['Controller' => 'AuthController', 'action' => 'login']);
$route->add("/register", ['Controller' => 'AuthController', 'action' => 'register']);
$route->add("/login", ['Controller' => 'AuthController', 'action' => 'login']);
$route->add("/listContacts", ['Controller' => 'ContactsController', 'action' => 'listContacts']);
$route->add("/logout", ['Controller' => 'AuthController', 'action' => 'logout'], );
$route->add("/addContact", ['Controller' => 'ContactsController', 'action' => 'addContact']);
$route->add("/deleteContact", ['Controller' => 'ContactsController', 'action' => 'deleteContact']);
$route->add("/countries", ['Controller' => 'ContactsController', 'action' => 'getCounties']);
$route->add("/states", ['Controller' => 'ContactsController', 'action' => 'getStates']);
$route->add('/editContact', ['Controller'=> 'ContactsController','action' => 'editContact']);

$routeParams = $route->findRoute($requestUri);
if (!$routeParams) {
    require_once './view/pageNotFound.php';
    exit;
}

if (($requestUri == '/login' || $requestUri == '/') && isset($_SESSION['user_id'])) {
    header('Location: /listContacts');
    exit;
}

if (!isset($_SESSION['user_id']) && !($requestUri == '/login' || $requestUri == '/register')) {
    header('Location: /login');
    exit;
}
$controllerName = $routeParams['Controller'];
$actionName = $routeParams['action'];

require_once sprintf("controller/%s.php", $controllerName);

$controllerObject = new $controllerName($requestUri);
$controllerObject->$actionName();