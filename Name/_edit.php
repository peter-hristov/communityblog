<?php

	require "./database.php";
	$connection = getPDO();
	$statement = $connection->prepare("UPDATE buildings SET `name`=:name,`height`=:height,`color`=:color WHERE `id`=:id");
	$statement->execute(array(
		":id" => $_POST["id"],
		":name" => $_POST["name"],
		":height" => $_POST["height"],
		":color" => $_POST["color"]));
	header("Location: /name/list.php");
	die();

?>

