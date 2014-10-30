<?php

//require './helpers/UsersHelper.php';
//
$helper = $_GET['helper'].'Helper';
$action = $_GET['action'];

require './helpers/'.$helper.'.php';

(new $helper())->$action();