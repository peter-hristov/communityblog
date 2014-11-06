<?php

require 'init.php';

$helper = "\\app\\helpers\\".$_GET['helper'].'Helper';
$action = $_GET['action'];

(new $helper())->$action();