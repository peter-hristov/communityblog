<?php

session_start();

if ( !defined("__DIR__")) define("__DIR__", dirname(__FILE__));
if ( !defined("__ROOT__")) define("__ROOT__", __DIR__);
if ( !defined("__APPNAME__")) define("__APPNAME__", array_pop(explode('/', __ROOT__ )));

require './include/Utils/Utils.php';


// Autoloader setup
function autoloadController($class)
{
    $parts = explode('\\', $class);
    require __ROOT__.'/'.implode('/', $parts).'/'.end($parts).'.php';
}

// To Do :
// Implemented a recursive directory iterator for the include folder
function autoloadInclude($class)
{

}

spl_autoload_register('autoloadController');
spl_autoload_register('autoloadInclude');



$router = array();

//Setting up the router
if(!empty($_GET['page'])){
    $router['controller'] = $_GET['page'].'Controller';
    unset($_GET['page']);
}
//Default Value
else {
    $router['controller'] = 'PagesController';
}


if(!empty($_GET['action']))
{
    $router['action']=$_GET['action'];
    unset($_GET['action']);
}
else
    $router['action']='Index';


if(!empty($_GET['arg']))
    $router['arg'] = $_GET['arg'];