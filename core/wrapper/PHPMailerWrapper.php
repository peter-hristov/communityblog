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
        // Taken from the PHPMailer Examples
        $this->mailer = new \PHPMailer();
        // Enable SMTO
        $this->mailer->IsSMTP();
         // debugging: 1 = errors and messages, 2 = messages only
        $this->mailer->SMTPDebug = 0;
        // authentication enabled
        $this->mailer->SMTPAuth = true;
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->Host = "smtp.gmail.com";
        $this->mailer->Port = 465;
        $this->mailer->IsHTML(true);
        $this->mailer->Username = 'partyplant.blog@gmail.com';
        $this->mailer->Password = 'theCakeisapie3';
    }

    public function sendEmail($from, $to, $subject, $body)
    {
        $this->mailer->SetFrom($from);
        $this->mailer->AddAddress($to);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $body;
        $this->mailer->Send();
    }
}
