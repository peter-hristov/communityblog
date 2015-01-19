<?php require "header.php" ?>
<?php require "navbar.php" ?>
<div class="container">
	<h1> Name consists of buildings: </h1>

		<?php
			require "./database.php";
			$connection = getPDO();
			$statement = $connection->prepare("SELECT * FROM buildings");
			$statement->execute();
			$datarow = array();
			while($row= $statement->fetch(\PDO::FETCH_ASSOC)) {
					$datarow[] = $row;
			}
			//echo "<pre>";
			//print_r($datarow);
			//echo "</pre>";

		?>
<table class="table table-hover">
	
	<tr>
		<th>Name</th>
		<th>Height</th>
		<th>Color</th>
		<th> </th>	
	</tr>
	<?php foreach ($datarow as $element):; ?>
		<tr>
			<td><?php echo $element["name"] ?></td>
			<td><?php echo $element["height"] ?></td>
			<td><?php echo $element["color"] ?></td>
			<td><a href="./edit.php?id=<?php echo $element["id"]?> "> Edit </a> / <a href="./delete.php?id=<?php echo $element["id"]?> "> Delete </a></td>
		</tr>
		
	<?php endforeach; ?>
</table>
</div>


<?php require "footer.php" ?>