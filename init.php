<?php
session_start();

// Some handy applicationwide vars
if (!defined("__DIR__")) define("__DIR__", dirname(__FILE__));
if (!defined("__ROOT__")) define("__ROOT__", __DIR__);
if (!defined("__APPNAME__")) define("__APPNAME__", array_pop(explode('/', __ROOT__)));

// This is either dev.{developer handle} or just production
if (!defined("__ENVIRONMENT__")) define("__ENVIRONMENT__", 'dev.peter');

if ( __ENVIRONMENT__ == 'production') {
    if (!defined("__SITENAME__")) define("__SITENAME__", 'partyplant.eu');
}

if ( __ENVIRONMENT__ == 'dev.peter') {
    if (!defined("__SITENAME__")) define("__SITENAME__", 'partyplant.dev');
}

// Autoloader for all framework and app classes
function autoloadAll($class)
{
    $parts = explode('\\', $class);
    include __ROOT__ . '/' . implode('/', $parts) . '.php';
}

spl_autoload_register('autoloadAll');

// Composer Autoloader
require __ROOT__.'/vendor/autoload.php';

// Initiazing the static classes
\core\wrapper\FacebookWrapper::init();
\app\model\Ubermodel::initialize();

// This is just for convenience
class_alias('\\core\\utils\\Utils', 'Utils', true);

// Getting request controller and anction from router
$router = new \core\router\Router($_GET);
