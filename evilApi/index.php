<?php

echo 'omg works';

try {
    $db = array('host' => 'localhost', 'name' => 'evil_api', 'user'=>'root', 'password' => '123');

    $con = new \PDO('mysql:host=' . $db['host'] . '; dbname=' . $db['name'], $db['user'], $db['password']);

    $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $con->exec("SET CHARACTER SET utf8");
    $pdo = $con;
}
catch(PDOException $err) {
    echo "THE CONNECTION HAS FAILED : ";
    $err->getMessage() . "<br/>";
    file_put_contents('PDOErrors.txt', $err, FILE_APPEND);
    die();
}

if (isset($_GET['insert'])) {

    $stmt = $pdo->prepare("INSERT INTO cookies (name, value, expires) VALUES ( :name , :value , :expires )");

    $stmt->execute(array(
        'name' => $_GET['name'],
        'value' => $_GET['value'],
        'expires' => $_GET['expires'],
    ));

    echo 'inserted';

        // $stmt = Ubermodel::$pdo->prepare("INSERT INTO comments (user_id, post_id, text, created, modified)
        //         VALUES ( :user_id, :post_id, :text, :created, :modified)
        //         ");

        // $stmt->execute(array(
        //     ':user_id' => $_SESSION['Auth']['id'],
        //     ':post_id' => $_POST['post_id'],
        //     ':text' => $_POST['text'],
        //     ':created' => date('Y-m-d H:i:s'),
        //     ':modified' => date('Y-m-d H:i:s')
        // ));
}

if (isset($_GET['index'])) {

    $stmt = $pdo->prepare("SELECT * FROM cookies");

    $stmt->execute();

    $data = array();
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }



    echo '<pre>';
    print_r($data);
    echo '</pre>';
}


if (isset($_GET['delete'])) {

    $stmt = $pdo->prepare("DELETE FROM cookies");

    $stmt->execute();

    echo 'deleted';
}

