
<?php 
	require "./database.php";
	$connection = getPDO();
	$statement = $connection->prepare("INSERT INTO users (username, password, `e-mail`) VALUES (:username,:password,:email)");
	$statement->execute(array(
		":username" => $_POST["username"],
		":password" => md5($_POST["password"]),
		":email" => $_POST["e-mail"]));



	header("Location: /name/successful.php");
	die();

?>
