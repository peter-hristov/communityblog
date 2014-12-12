<?php

$a = array(1,2,3,4);
header('Content-Type: html');

echo $_GET['callback'].'('.json_encode($a).');';