<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - index()
* - view()
* - add()
* - edit()
* - delete()
* Classes list:
* - PostsController extends core
*/
namespace app\controller;
use app\model\Ubermodel as Ubermodel;

class PostsController extends \core\controller\Controller
{

    function __construct()
    {
        parent::__construct();
        $this->tableName = "posts";
    }

    public function index($options = array())
    {
        $data['Posts'] = Ubermodel::getAll($this->tableName);
        echo $this->renderView('Posts/index', compact('data'));
    }

    public function view($options = array())
    {
        $data['Posts'] = Ubermodel::getOne($this->tableName, 'id', $options['id']);

        $statement = Ubermodel::$pdo->prepare('
            SELECT users.id userID, comments.id commentID, comments.text, users.email, comments.post_id
            FROM users
            RIGHT JOIN comments
            ON users.id = comments.user_id
            WHERE comments.post_id = :id
        ');

        $statement->execute(array(
            ':id' => $options['id']
        ));

        $data['Comments'] = array();
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $data['Comments'][] = $row;
        }

        echo $this->renderView('Posts/view', compact('data'));
    }

    public function add()
    {
        if (!\Utils::isUserLogged()) {
            header('Location: /index.php?page=Pages&action=notlogged');
            die();
        }
        if (!empty($_POST)) {
            $stmt = Ubermodel::$pdo->prepare("INSERT INTO posts (user_id, status, title, body, created, modified)
                     VALUES ( :user_id, :status, :title, :body, :created, :modified)
                    ");

            $stmt->execute(array(
                ':user_id' => 1,
                ':status' => 0,
                ':title' => $_POST['title'],
                ':body' => $_POST['body'],
                ':created' => date('Y-m-d H:i:s') ,
                ':modified' => date('Y-m-d H:i:s')
            ));

            header('Location: /index.php?page=Posts');
            die();
        }
        echo $this->renderView('Posts/add');
    }

    public function edit($options = array())
    {
        if (!\Utils::isUserLogged()) {
            header('Location: /index.php?page=Pages&action=notlogged');
            die();
        }

        if (!empty($_POST)) {

            $stmt = Ubermodel::$pdo->prepare("
                    UPDATE posts
                    SET title=:title, body=:body, modified=:modified
                    WHERE id=:id
            ");
            $stmt->execute(array(
                ':id' => $_POST['id'],
                ':title' => $_POST['title'],
                ':body' => $_POST['body'],
                ':modified' => date('Y-m-d H:i:s')
            ));

            header('Location: /index.php?page=Posts');
            die();
        }

        $data = Ubermodel::getOne($this->tableName, 'id', $options['id']);

        echo $this->renderView('Posts/edit', compact('data'));
    }

    public function delete()
    {
        if (!\Utils::isUserLogged()) {
            header('Location: /index.php?page=Pages&action=notlogged');
            die();
        }
        if (!empty($_POST)) {
            $id = $_POST['id'];
            $stmt = Ubermodel::$pdo->prepare('DELETE FROM posts WHERE id = ' . $id);
            $stmt->execute();
            header('Location: /index.php?page=Posts');
            die();
        }
    }
}