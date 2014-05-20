<?php

require 'Controller.php';

class OrdersController extends Controller{

	public function index($args = array())
	{
		if(!empty($_SESSION['basket']))
			{
			$items = array();

			foreach ($_SESSION['basket'] as $a) {
				$items[]=$a;
			}

			$data=array();

			foreach ($items as $i) {

				$stmt = $this->pdo->prepare("SELECT Cars.name,Cars.price,Cars.id from Cars where Cars.id = :id");
				$stmt->execute(array(':id' => $i));

				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$data[] = $row;
				}
			}
		}

		if(isset($args['ordered']) && $args['ordered']==1)
			echo 'Успешна поръчка!';
		echo $this->renderView('Orders/index',compact('data'));
	}



	public function addToBasket($args = array())
	{
		if(isset($args['itemID']))
		{
			$_SESSION['basket']['car']=$args['itemID'];
			header("Location: /car/index.php?page=Types");
		}
	}



	public function clearBasket($args = array())
	{
		$_SESSION['basket']=null;
		header("Location: /car/index.php?page=Orders");
	}


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
}
