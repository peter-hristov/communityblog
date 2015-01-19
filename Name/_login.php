
<?php
echo "<pre>";

print_r($_POST);
echo "</pre>";
?>

<?php 
	require "./database.php";
	$connection = getPDO();
	$statement = $connection->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
	$statement->execute(array(
		":username" => $_POST["username"],
		":password" => md5($_POST["password"])));

	$datarow = $statement->fetch(\PDO::FETCH_ASSOC);

			
			echo "<pre>";

			print_r($_POST);
			echo "</pre>";
						
			if (isset($datarow)){

				session_start();
				$_SESSION["Auth"] = $datarow;
				
			}

	header("Location: /name/successful.php");
	die();

?>
