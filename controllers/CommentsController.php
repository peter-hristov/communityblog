<?php

require 'Controller.php';

class CommentsController extends Controller{


	function __construct()
	{
		parent::__construct();
		$this->tableName = "comments";
	}

	public function add()
	{
		if(!empty($_POST)) {

			//debug($_POST);
			//die();

			$stmt = $this->pdo->prepare(
					"INSERT INTO comments (user_id, post_id, text, created, modified)
					 VALUES ( :user_id, :post_id, :text, :created, :modified)
					");

			$stmt->execute(array(
			':user_id' => $_SESSION['Auth']['id'],
			':post_id' => $_POST['post_id'],
			':text' => $_POST['text'],

			':created'=>date('Y-m-d H:i:s'),
			':modified'=>date('Y-m-d H:i:s')));

			header('Location: /'.__APPNAME__.'/index.php?page=Posts');
			die();
		}

		echo $this->renderView('Comments/add');
	}
}