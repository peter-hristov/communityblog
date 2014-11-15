<?php

namespace core\wrapper;

class FacebookWrapper
{
    static function init()
    {
        $appId = '733952263324571';
        $secredId = 'e237a193c491522f82908a4776aa8dc3';
        $redirect_url = 'http://localhost:8080/index.php?page=Users&action=blqLogin';
        \Facebook\FacebookSession::setDefaultApplication($appId, $secredId);
    }

    static function getLoginUrl()
    {
        $redirect_url = 'http://localhost:8080/index.php?page=Users&action=blqLogin';
        return (new \Facebook\FacebookRedirectLoginHelper($redirect_url))->getLoginUrl();
    }
}