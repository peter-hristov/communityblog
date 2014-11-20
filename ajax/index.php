<?php

require '../init.php';

$helper = "\\app\\helper\\".$_GET['helper'].'Helper';
$action = $_GET['action'];

unset($_GET['helper']);
unset($_GET['action']);

header('content-disposition: application/json; charset=utf-8');

echo json_encode($helper::$action($_GET));