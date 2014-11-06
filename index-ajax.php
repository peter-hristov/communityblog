<?php

require 'init.php';

$helper = "\\app\\controller\\".$_GET['controller'].'Controller';

$action = $_GET['action'];

$msg = (new $helper())->$action();

echo $msg;