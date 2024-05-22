<?php

require_once "router/Router.php";
require_once "helper/SessionHelper.php";

$requestUri = strtok($_SERVER['REQUEST_URI'], '?');

$route = new Router();

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