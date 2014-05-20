<?php

require 'Controller.php';

class HomepageController extends Controller{


    public $a = 10;

    public function index()
    {






        echo $this->renderView('homepage');
    }
}