<?php

require 'Controller.php';

class HomepageController extends Controller{

    public function index()
    {
        echo $this->renderView('homepage');
    }
}