<?php
namespace core\router;

class Router
{

    public function getController()
    {
        return $this->router['controller'];
    }

    public function __get($propertyName)
    {
        switch($propertyName) {

            case 'controller':
                return (string)$this->router['controller'];

            case 'action':
                return (string)$this->router['action'];
        }
    }

    private $router = array();

    public function __construct($req)
    {
        $this->router['controller'] = '\\app\\controllers\\';

        //Setting up the router
        if(!empty($req['page'])){
            $this->router['controller'] .= $req['page'].'Controller';
            unset($req['page']);
        }
        //Default Value
        else {
            $this->router['controller'] .= 'PagesController';
        }

        if(!empty($req['action']))
        {
            $this->router['action']=$req['action'];
            unset($req['action']);
        }
        else
            $this->router['action']='index';

        if(!empty($req['arg']))
            $this->$router['arg'] = $req['arg'];
    }
}
