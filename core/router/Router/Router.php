<?php
namespace core\router;

class Router {

    public function __get($propertyName) {
        switch($propertyName) {
            case 'controller':
                return $this->router['controller'];
            case 'action':
                return $this->router['action'];
        }
    }

    private $router = array();

    public function __construct($req)
    {
        //Setting up the router
        if(!empty($req['page'])){
            $this->router['controller'] = $req['page'].'Controller';
            unset($req['page']);
        }
        //Default Value
        else {
            $this->router['controller'] = 'PagesController';
        }

        if(!empty($req['action']))
        {
            $this->router['action']=$req['action'];
            unset($req['action']);
        }
        else
            $this->router['action']='Index';


        if(!empty($req['arg']))
            $this->$router['arg'] = $req['arg'];

    }
}
