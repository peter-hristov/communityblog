<?php

namespace core\controller;

class Controller
{
    protected $tableName;
    protected $mailer;

    public function __construct()
    {
        $this->mailer = new \core\wrapper\PHPMailerWrapper();
    }

    public function renderView($viewName, $data = array())
    {
        $view = __ROOT__ . "/views/{$viewName}.php";

        if (!is_readable($view)) {
            throw new \Exception("Something Failed :/ ");
        }
        extract($data);
        ob_start();
        include $view;
        return ob_get_clean();
    }
}
