<?php

require 'Controller.php';

class TypesController extends Controller{

	public function index($args = array())
	{
		$stmt = $this->pdo->prepare('SELECT * from Types');
		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $row;
		}
		echo $this->renderView('Types/index',compact('data'));
	}

	public function view($args = array())
	{
		$id = $args['id'];

		if(!empty($id))
		{
			$stmt = $this->pdo->prepare(

				'SELECT Accessoires.name as ing_name,Cars.name as f_name,Cars.id

				from Car_Accessoire

				left join Cars
				on Car_Accessoire.car_id = Cars.id

				left join Accessoires
				on Car_Accessoire.accessoire_id = Accessoires.id

				where Cars.type_id=:id'
			);

			$stmt->execute(array('id'=>$id));

			$data=array();
			$lastID=-1;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				if($row['id']!=$lastID)
				{
					$lastID=$row['id'];
					$data[$lastID]['name'] = $row['f_name'];
					$data[$lastID]['id'] = $row['id'];
				}
				$data[$lastID][] = $row;
			}

			echo $this->renderView('Types/view',compact('data'));
		}
	}
}