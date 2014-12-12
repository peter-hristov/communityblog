<?php

namespace app\helper;
use app\model\Ubermodel as Ubermodel;

class UsersHelper extends \core\helper\Helper
{

    // Api
    public function doesUserExist($args)
    {
        $user = Ubermodel::getOne('users', 'email', $args['email']);

        return $user;
    }

    public function apiIndex($args = array())
    {
        $user = Ubermodel::getAll('users', array(
            'SELECT' => array('email', 'name', 'gender', 'birth_date'),
        ));

        return $user;
    }

    public function apiView($args = array())
    {
        //$user = Ubermodel::getOne('users', $args['column'], $args['data']);
       $user = Ubermodel::getAll('users', array(
           'SELECT' => array('email', 'name', 'gender', 'birth_date'),
           'WHERE' => array($args['column'] => $args['data'])
        ));
        return $user;
    }

    static function testResponse()
    {
        return 'Success!';
    }
}