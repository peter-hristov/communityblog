<?php

require '../init.php';

$helper = "\\app\\helper\\".$_GET['helper'].'Helper';
$action = $_GET['action'];

unset($_GET['helper']);
unset($_GET['action']);

echo $helper::$action($_GET);