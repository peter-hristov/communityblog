<?php

require 'Controller.php';

class PagesController extends Controller{


    public function Index()
    {
        echo $this->RenderView('Pages/homepage');
    }

    public function Notlogged()
    {
        echo $this->RenderView('Pages/notlogged');
    }
}
