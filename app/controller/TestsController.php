<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - ajax()
* - jquery()
* Classes list:
* - TestsController extends core
*/
namespace app\controller;

class TestsController extends core\controller\Controller
{
    function __construct()
    {
        parent::__construct();
        $this->tableName = "tests";
    }

    public function ajax()
    {
        echo $this->renderView('Tests/ajax');
    }

    public function jquery()
    {
        echo $this->renderView('Tests/jquery');
    }
}
