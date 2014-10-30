<?php
/**
* Class and Function List:
* Function list:
* - createCaptcha()
* Classes list:
* - CaptchaWrapper
*/
namespace core\wrapper;

class CaptchaWrapper
{
    static public function createCaptcha($environment)
    {
        $captcha = new \Captcha\Captcha();

        if (strtolower($environment) == 'production') {
            $captcha->setPublicKey('6LcwQPwSAAAAAEaSdomAVBdEa_ZcPFIENzzAaukT');
            $captcha->setPrivateKey('6LcwQPwSAAAAAEITEtwbGBet_tltApNYbh0oDag9');
        }

        if (strtolower($environment) == 'dev.peter') {
            $captcha->setPublicKey('6LdrO_wSAAAAAKm8_PxSJGreOdLVBAoGP2Gi3zgn');
            $captcha->setPrivateKey('6LdrO_wSAAAAAMH6Ds8YRPAkcKozZX80iGXUsr50');
        }

        return $captcha;
    }
}
