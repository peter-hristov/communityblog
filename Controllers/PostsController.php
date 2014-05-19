<?php

require 'Controller.php';

class PostsController extends Controller{

	public function index()
	{
		$statement = $this->pdo->prepare('SELECT * from posts');
		$statement->execute();

		while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $row;
		}

		echo $this->renderView('Posts/index', compact('data'));
	}
}