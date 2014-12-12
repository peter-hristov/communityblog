<?php

namespace core\wrapper;

class FacebookWrapper
{
    static $config;

    static function init()
    {
        self::$config = require __ROOT__.'/config/facebook.'.__ENVIRONMENT__.'.config.php';
        \Facebook\FacebookSession::setDefaultApplication(self::$config['app_id'], self::$config['secret_id']);
    }

    static function getLoginUrl()
    {
        return (new \Facebook\FacebookRedirectLoginHelper(self::$config['redirect_url']))->getLoginUrl();
    }

    static function getSessionFromRedirect()
    {
        return (new \Facebook\FacebookRedirectLoginHelper(self::$config['redirect_url']))->getSessionFromRedirect();
    }

    static function getUserProfileFromRedirect()
    {
        $session = self::getSessionFromRedirect();
        return (new \Facebook\FacebookRequest( $session, 'GET', '/me' ))->execute()->getGraphObject(\Facebook\GraphUser::className());
    }
}