<?php

session_start();

$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

require "../app/controllers/" . ucfirst($controller) . "Controller.php";

$controllerName = ucfirst($controller) . "Controller";
$obj = new $controllerName();

if (!method_exists($obj, $action)) {
    die("Action not found");
}

$obj->$action();