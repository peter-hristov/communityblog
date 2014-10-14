<?php
namespace Core\Controller;

require 'Controller.php';

class PagesController extends Controller{

    public function index()
    {
        echo $this->renderView('Pages/homepage');
    }

    public function notlogged()
    {
        echo $this->renderView('Pages/notlogged');
    }
}
