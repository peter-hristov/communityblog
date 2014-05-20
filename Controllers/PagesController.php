<?php

require 'Controller.php';

class PagesController extends Controller{


	public function index()
	{
		echo $this->renderView('homepage');
	}

	public function notlogged()
	{
		echo $this->renderView('notlogged');
	}
}