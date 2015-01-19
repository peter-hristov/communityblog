<?php

	require "./database.php";
	$connection = getPDO();
	$statement = $connection->prepare("DELETE FROM buildings WHERE `id`=:id");
	$statement->execute(array(
		":id" => $_GET["id"]));
	header("Location: /name/list.php");
	die();
?>