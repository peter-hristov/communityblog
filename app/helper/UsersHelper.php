<?php

namespace app\helper;
use app\model\Ubermodel as Ubermodel;

class UsersHelper extends \core\helper\Helper
{
    static function doesUserExist($args)
    {
        $user = Ubermodel::getOne('users', 'email', $args['email']);

        return $user;
    }

    static function testResponse()
    {
        return 'Success!';
    }

}