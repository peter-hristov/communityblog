<?php

namespace app\model;

class Ubermodel extends \core\wrapper\PDOWrapper
{
    // Framework like get stuff
    static public function getOne($tableName, $name, $value)
    {
        if ($tableName && $value) {
            $statement = self::$pdo->prepare('SELECT * from ' . $tableName . " WHERE {$name}=:value");
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
    static public function getAll($tableName, $options = array())
    {
        if (!empty($tableName)) {

            if (isset($options['SELECT'])) {
                $query = 'SELECT ' . implode(',', $options['SELECT']) . ' ';
            } else {
                $query = 'SELECT * ';
            }

            $query.= 'FROM ' . $tableName . ' ';

            if (isset($options['WHERE'])) {
                $query.= 'WHERE ' . self::constructWhere($options['WHERE']);
            }

            if (isset($options['LIMIT'])) {
                $query.= ' LIMIT ' . $options['LIMIT'];
            }

            $statement = self::$pdo->prepare($query);
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
    static private function constructWhere($q, $glue = null)
    {
        $temp = array();
        foreach ($q as $key => $value) {
            if (strtoupper($key) === 'AND' || strtoupper($key) === 'OR') {
                $temp[] = self::constructWhere($value, $key);
            } else {
                $temp[] = self::formExpression($key,$value);
            }
        }
        return '(' . implode(' ' . $glue . ' ', $temp) . ')';
    }

    static private function formExpression($key, $value)
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
