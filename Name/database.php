<?php


function getPDO() {

	try {

		$db = array("host"=>"localhost", "name"=>"name", "user"=>"root", "password"=>"rcdudepass1");
		$connection = new PDO('mysql:host=' . $db['host'] . '; dbname=' . $db['name'], $db['user'], $db['password']);
		$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$connection->exec("SET CHARACTER SET utf8");

		}
	catch(PDOException $err) {
		echo "THE CONNECTION HAS FAILED : ";
		$err->getMessage() . "<br/>";
		file_put_contents('PDOErrors.txt', $err, FILE_APPEND);
		die();
		}
	return $connection;
}


?>