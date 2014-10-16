<?php
/**
* Class and Function List:
* Function list:
* - debug()
* - isUserLogged()
* Classes list:
* - Utils
*/
namespace core\utils;

class Utils
{

    public static function debug($x)
    {
        echo '<pre>';
        print_r($x);
        echo '</pre>';
    }

    public static function isUserLogged()
    {
        if (session_status() != PHP_SESSION_NONE && !empty($_SESSION['Auth'])) return true;
        return false;
    }
}
