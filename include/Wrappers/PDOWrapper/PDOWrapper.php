<?php
namespace Core\Wrapper;

class PDOWrapper
{
    protected $dbh;

    public function __construct()
    {
        try {
            $db_host = 'localhost';  //  hostname
            $db_name = 'communityblog';  //  databasename
            $db_user = 'root';  //  username
            $user_pw = '123';  //  password

            $con = new \PDO('mysql:host='.$db_host.'; dbname='.$db_name, $db_user, $user_pw);
            $con->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
            $con->exec("SET CHARACTER SET utf8");  //  return all sql requests as UTF-8

            $this->dbh = $con;
        }
        catch (PDOException $err) {
            echo "THE CONNECTION HAS FAILED : ";
            $err->getMessage() . "<br/>";
            file_put_contents('PDOErrors.txt',$err, FILE_APPEND);
            die();  //  terminate connection
        }
    }

    public function getPDO()
    {
        return $this->dbh;
    }
}