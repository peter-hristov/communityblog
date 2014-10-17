<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - renderView()
 * - getOne()
 * - getAll()
 * Classes list:
 * - Controller
 */
namespace core\controller;

class Controller
{

    protected $pdo;
    protected $tableName;
    protected $mailer;

    public function __construct()
    {
        $this->pdo = (new \core\wrapper\PDOWrapper())->getPDO();
        $this->mailer = new \core\wrapper\PHPMailerWrapper();
    }

    public function renderView($viewName, $data = array())
    {
        $view = __ROOT__ . "/views/{$viewName}.php";
        if (!is_readable($view)) throw new Exception("Something Failed :/ ");
        extract($data);
        ob_start();
        include $view;
        return ob_get_clean();
    }

    // Framework like get stuff
    public function getOne($name, $value)
    {
        if ($this->tableName && $value) {
            $statement = $this->pdo->prepare('SELECT * from ' . $this->tableName . " WHERE {$name}=:value");
            $statement->execute(array(
                'value' => $value
            ));
            $row = $statement->fetch(\PDO::FETCH_ASSOC);
            return $row;
        }
        return null;
    }

    public function getAll($options = array())
    {

        if ($this->tableName) {

            $query = 'SELECT * from ' . $this->tableName;

            if (!empty($options['WHERE'])) {
                $query.= ' WHERE ';
                foreach ($options['WHERE'] as $key => $value) {
                    $temp[] = $key . '=' . '"' . $value . '"';
                }
                $query.= implode(' AND ', $temp);
            }

            $statement = $this->pdo->prepare($query);
            $statement->execute();

            $data = array();
            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        return null;
    }
}
