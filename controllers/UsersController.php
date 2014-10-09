<?php

require 'Controller.php';

class UsersController extends Controller{


    function __construct()
    {
        parent::__construct();
        $this->tableName = "users";
    }

    public function add()
    {
        if(!empty($_POST)) {

            $stmt = $this->pdo->prepare(
                    "INSERT INTO users (email, password, created)
                     VALUES ( :email, :password, :created)
                    ");

            $stmt->execute(array(
            ':email' => $_POST['email'],
            ':password' => md5($_POST['password']),
            ':created'=>date('Y-m-d H:i:s')));

            header('Location: /'.__APPNAME__.'/index.php?page=Posts');
            die();
        }

        echo $this->renderView('Users/add');
    }

    public function login()
    {
        if(!empty($_POST)) {

            $user = $this->getAll(array('WHERE' => array('email' => $_POST['email'], 'password' => md5($_POST['password']))));

            if(!empty($user)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['Auth'] = $user[0];
            }
            header('Location: /'.__APPNAME__.'/index.php?page=Posts');
            die();
        }
        echo $this->renderView('Users/login');
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('Location: /'.__APPNAME__.'/index.php?page=Posts');
        die();
    }
}