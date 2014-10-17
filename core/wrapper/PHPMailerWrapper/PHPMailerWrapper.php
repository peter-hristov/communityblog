<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - sendEmail()
* Classes list:
* - PHPMailerWrapper
*/
namespace core\wrapper;

require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

// PHPMailer Wrapper

class PHPMailerWrapper
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new \PHPMailer();
         // create a new object

        $this->mailer->IsSMTP();
         // enable SMTP

        $this->mailer->SMTPDebug = 0;
         // debugging: 1 = errors and messages, 2 = messages only

        $this->mailer->SMTPAuth = true;
         // authentication enabled

        $this->mailer->SMTPSecure = 'ssl';
         // secure transfer enabled REQUIRED for GMail

        $this->mailer->Host = "smtp.gmail.com";

        $this->mailer->Port = 465;
         // or 587

        $this->mailer->IsHTML(true);

        $this->mailer->Username = "peter.g.hristov@gmail.com";

        $this->mailer->Password = "epicpass1";
    }

    public function sendEmail($from, $to, $subject, $body)
    {

        $this->mailer->SetFrom($from);

        $this->mailer->AddAddress($to);

        $this->mailer->Subject = $subject;

        $this->mailer->Body = $body;

        $this->mailer->Send();

        // if(!$this->mailer->Send())

        // throw new myPHPMailerError($this->mailer->ErrorInfo);

    }
}
