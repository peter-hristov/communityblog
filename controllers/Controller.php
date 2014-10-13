<?php

require __ROOT__.'/include/classes/pdo_connect.php';
require __ROOT__.'/include/classes/MyPHPMailer/MyPHPMailer.php';

class Controller{

    protected $pdo;
    protected $tableName;
    protected $mailer;

    public function __construct()
    {
        $this->pdo = (new pdo_connect())->getPdo();
        $this->mailer = new MyPHPMailer();
    }


    public function RenderView($viewName, $data = array() )
    {
        $view = __ROOT__. "/views/{$viewName}.php";
        if ( !is_readable($view)) throw new Exception("Something Failed :/ ");
        extract($data);
        ob_start();
        include $view;
        return ob_get_clean();
    }




    // Framework like get stuff

    public function GetOne($id = null) {
        if($this->tableName && $id) {
            $statement = $this->pdo->prepare('SELECT * from '.$this->tableName.' WHERE id=:id');
            $statement->execute(array('id' => $id));
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        return null;
    }

    public function GetAll($options = array()) {

        if($this->tableName) {

            $query = 'SELECT * from '.$this->tableName;

            if(!empty($options['WHERE'])) {
                $query.=' WHERE ';
                foreach ($options['WHERE'] as $key => $value) {
                    $temp[] = $key.'='.'"'.$value.'"';
                }
                $query .= implode(' AND ', $temp);
            }

            $statement = $this->pdo->prepare($query);
            $statement->execute();

            $data = array();
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        return null;
    }
}
