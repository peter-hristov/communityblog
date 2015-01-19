<?php 
	require "./database.php";
	$connection = getPDO();
	$statement = $connection->prepare("INSERT INTO buildings (name, height, color) VALUES (:name,:height,:color)");
	$statement->execute(array(
		":name" => $_POST["name"],
		":height" => $_POST["height"],
		":color" => $_POST["color"]));



	header("Location: /name/list.php");
	die();

?>
