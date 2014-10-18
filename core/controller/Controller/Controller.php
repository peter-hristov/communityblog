<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - renderView()
 * - getOne()
 * - getAll()
 * - constructWhere()
 * - formExpression()
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

    /**
     * Get All rows that that match the specified conditions
     * @param  array  $options can specify the SELECT and WHERE clasue
     * @return array          All Rows Return from the query. Null otherwise
     */
    public function getAll($options = array())
    {
        if (!empty($this->tableName)) {

            if (isset($options['SELECT'])) {
                $query = 'SELECT ' . implode(',', $options['SELECT']) . ' ';
            } else {
                $query = 'SELECT * ';
            }

            $query.= 'FROM ' . $this->tableName . ' ';

            if (isset($options['WHERE'])) {
                $query.= 'WHERE ' . $this->constructWhere($options['WHERE']);
            }

            if (isset($options['LIMIT'])) {
                $query.= ' LIMIT ' . $options['LIMIT'];
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

    /**
     * A Divide and Conquer algorithm for translating $options['WHERE'] $this->getAll to a proper Mysql string
     * @param  array $q     Where clause as an array
     * @param  string $glue Specify whether to join statements using 'OR' or 'AND'
     * @return string       Mysql compatable string
     */
    private function constructWhere($q, $glue = null)
    {
        $temp = array();
        foreach ($q as $key => $value) {
            if (strtoupper($key) === 'AND' || strtoupper($key) === 'OR') {
                $temp[] = $this->constructWhere($value, $key);
            } else {
                $temp[] = $this->formExpression($key,$value);
            }
        }
        return '(' . implode(' ' . $glue . ' ', $temp) . ')';
    }

    public function formExpression($key, $value)
    {
        if (!is_array($value)) {
            $value = array('=', $value);
        }
        if (strtoupper($value[0]) == 'LIKE') {
            $value[1] = '%'.$value[1].'%';
        }
        return $key . ' '.$value[0].' ' . '"' . $value[1] . '"';
    }
}
