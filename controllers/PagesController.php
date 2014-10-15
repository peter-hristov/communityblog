<?php

class PagesController extends core\controller\Controller{

    public function index()
    {
        echo $this->renderView('Pages/homepage');
    }

    public function notlogged()
    {
        echo $this->renderView('Pages/notlogged');
    }
}
