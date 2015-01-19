<?php require "header.php" ?>
<?php require "navbar.php" ?>
	<div class="container">
	<div class="col-sm-4">
	<?php 
	require "./database.php";
			$connection = getPDO();
			$statement = $connection->prepare("SELECT * FROM buildings WHERE id = ".":id");
			$statement->execute(array(
					":id" => $_GET["id"]
				));
			$datarow = array();
			while($row= $statement->fetch(\PDO::FETCH_ASSOC)) {
					$datarow[] = $row;
			}
	?>
	<form action="./_edit.php" method="POST" role="form">
		<input type="hidden" name="id" value="<?php echo $datarow[0]["id"] ?>">

		<div class="form-group"><label>Building</label><input value="<?php echo $datarow[0]["name"] ?>
		" class="txtbox form-control" type="text" id="name" name="name" required></div>

		<div class="form-group"><label>Height</label><input value="<?php echo $datarow[0]["height"] ?> 
		"class="txtbox form-control" type="text" id="height" name="height" required></div>

		<div class="form-group"><label>Color</label><input value="<?php echo $datarow[0]["color"] ?> 
		"class="txtbox form-control" type="text" id="color" name="color" required></div>


		<button type="submit" class="btn btn-default"> Edit </button>
		<button type="reset" class="btn btn-default" value="Reset"> Clear </button>
	</form>


	<?php require "footer.php" ?>
