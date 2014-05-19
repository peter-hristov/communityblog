<?php

require __ROOT__.'/Util/pdo_connect.php';

class Controller{

    protected $pdo;

    public function __construct()
    {
        $this->pdo = (new pdo_connect())->getPdo();
    }

    public function renderView($viewName, $data = array() )
    {
        $view = __ROOT__. "/views/{$viewName}.php";
        if ( !is_readable($view)) throw new Exception("Something Failed :/ ");
        extract($data);
        ob_start();
        include $view;
        return ob_get_clean();
    }
}