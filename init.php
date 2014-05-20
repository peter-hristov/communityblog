<?php


function debug($x = null)
{
	echo '<pre>';
	print_r($x);
	echo '</pre>';
}

function isUserLogged()
{
	if (session_status() != PHP_SESSION_NONE && !empty($_SESSION['Auth']))
		return true;
	return false;
}

session_start();

if ( !defined("__DIR__")) define("__DIR__", dirname(__FILE__));
if ( !defined("__ROOT__")) define("__ROOT__", __DIR__);
if ( !defined("__APPNAME__")) define("__APPNAME__", array_pop(explode('/', __ROOT__ )));

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
	$router['action']='index';

if(!empty($_GET['arg']))
	$router['arg'] = $_GET['arg'];