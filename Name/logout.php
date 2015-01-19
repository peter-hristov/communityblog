<?php	
	session_start();
	//$_SESSION=array();
	session_destroy();





	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	
	header("Location: /name/index.php");
	die();

?>