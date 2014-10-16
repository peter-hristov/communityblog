<?php

session_start();

if (!defined("__DIR__")) define("__DIR__", dirname(__FILE__));
if (!defined("__ROOT__")) define("__ROOT__", __DIR__);
if (!defined("__APPNAME__")) define("__APPNAME__", array_pop(explode('/', __ROOT__)));

// Autoloader setup
function autoloadCore($class)
{
    $parts = explode('\\', $class);
    require __ROOT__ . '/' . implode('/', $parts) . '/' . end($parts) . '.php';
}
spl_autoload_register('autoloadCore');

class_alias('\\core\\utils\\Utils', 'Utils', true);

$router = new core\router\Router($_GET);
