<?php

require 'Controller.php';

class PostsController extends Controller{


    function __construct()
    {
        parent::__construct();
        $this->tableName = "posts";
    }

    public function index( $options = array() )
    {
        $data['Posts'] = $this->getAll();

        // $a = $stuff['perPage'];
        // $b = $stuff['pagPage'];

        // $i = $a * $b;

        // $n = min($i + $a, count($data['Posts']));


        // $tempData['Posts'] = array();

        // while( $i < $n ){
        //     $tempData['Posts'][] = $data['Posts'][$i];
        //     $i++;
        // }


        // $data['Posts'] = $tempData['Posts'];

        echo $this->renderView('Posts/index', compact('data'));
    }

    public function view( $options = array() ) {

        $data = $this->getOne($options['id']);
        echo $this->renderView('Posts/view', compact('data'));
    }


    public function add()
    {
        if(!empty($_POST)) {
            $stmt = $this->pdo->prepare(
                    "INSERT INTO posts (user_id, status, title, body, created, modified)
                     VALUES ( :user_id, :status, :title, :body, :created, :modified)
                    ");

            $stmt->execute(array(
            ':user_id' => 1,
            ':status' => 0,

            ':title' => $_POST['title'],
            ':body' => $_POST['body'],

            ':created'=>date('Y-m-d H:i:s'),
            ':modified'=>date('Y-m-d H:i:s')));

            header('Location: /'.__APPNAME__.'/index.php?page=Posts');
            die();
        }

        echo $this->renderView('Posts/add');
    }

    public function edit( $options = array() )
    {
        if(!empty($_POST)) {
            $stmt = $this->pdo->prepare(
                    "UPDATE posts
                    SET title=:title, body=:body, modified=:modified
                    WHERE id=:id
                    ");
            $stmt->execute(array(
            ':id' => $_POST['id'],
            ':title' => $_POST['title'],
            ':body' => $_POST['body'],
            ':modified'=>date('Y-m-d H:i:s')));

            header('Location: /'.__APPNAME__.'/index.php?page=Posts');
            die();
        }

        $data = $this->getOne($options['id']);
        echo $this->renderView('Posts/edit', compact('data'));
    }


    public function delete()
    {
        if(!empty($_POST)) {
            $id = $_POST['id'];
            $stmt = $this->pdo->prepare('DELETE FROM posts WHERE id = '.$id);
            $stmt->execute();
            header('Location: /'.__APPNAME__.'/index.php?page=Posts');
            die();
        }
    }
}
