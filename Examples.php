<?php


	public function processOrder()
	{
		$stmt = $this->pdo->prepare("INSERT INTO Orders (address, date, car_id) VALUES ( :adrress, :date, :car_id) ");

		$stmt->execute(array(
			':adrress' => $_POST['address'],
			':date'=>date('Y-m-d H:i:s'),
			':car_id' => $_POST['car_id'] ));

		$_SESSION['basket']['car']=null;
		header("Location: /car/index.php?page=Orders&ordered=1");
	}