<?php
session_start();

// Some handy applicationwide vars
if (!defined("__DIR__")) define("__DIR__", dirname(__FILE__));
if (!defined("__ROOT__")) define("__ROOT__", __DIR__);
if (!defined("__APPNAME__")) define("__APPNAME__", array_pop(explode('/', __ROOT__)));

if (!defined("__SITENAME__")) define("__SITENAME__", 'partyplant.eu');



// This is either dev.{developer handle} or just production
if (!defined("__ENVIRONMENT__")) define("__ENVIRONMENT__", 'production');


// Autoloader setup for core framework files
function autoloadCore($class)
{
    $parts = explode('\\', $class);
    require __ROOT__ . '/' . implode('/', $parts) . '/' . end($parts) . '.php';
}
spl_autoload_register('autoloadCore');

// Composer Autoloader
require __ROOT__.'/vendor/autoload.php';

class_alias('\\core\\utils\\Utils', 'Utils', true);

$router = new core\router\Router($_GET);
