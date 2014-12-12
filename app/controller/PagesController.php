<?php

namespace app\controller;
use app\model\Ubermodel as Ubermodel;

class PagesController extends \core\controller\Controller
{
    public function index()
    {
        echo $this->renderView('Pages/homepage');
    }

    public function aboutUs()
    {
        echo $this->renderView('Pages/about-us');
    }

    public function construction()
    {
        echo $this->renderView('Pages/construction');
    }

    public function notlogged()
    {
        echo $this->renderView('Pages/notlogged');
    }
}
