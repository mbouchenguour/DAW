<?php
session_start();
require_once 'config/Config.php';
require_once 'config/Autoloader.php';
Autoloader::register();

if(!isset($_SESSION['theme'])){
    $_SESSION['theme'] = 'index2';
}

$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'AccueilController';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

if (!class_exists($controllerName) || !method_exists($controllerName, $actionName)) {
    header('HTTP/1.0 404 Not Found');
    exit('Page non trouvée');
}

$controller = new $controllerName();
$controller->$actionName();
