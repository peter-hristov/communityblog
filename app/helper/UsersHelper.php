<?php

namespace app\helper;
use app\model\Ubermodel as Ubermodel;

class UsersHelper extends \core\helper\Helper
{
    static function doesUserExist($args)
    {
        $user = Ubermodel::getOne('users', 'email', $args['email']);

        if (empty($user)) {
            return 0;
        }
        return 1;
    }

    static function testResponse()
    {
        return 'Success!';
    }

}