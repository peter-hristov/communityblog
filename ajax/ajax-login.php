<?php

require '../init.php';

$pdo = (new \core\wrapper\PDOWrapper())->getPDO();

$email = $_POST['email'];

$stmt = $pdo->prepare("SELECT users.id FROM users WHERE users.email = :email LIMIT 1");

$stmt->execute(array( ":email" => $email));

$user = array();

$user = $stmt->fetch(\PDO::FETCH_ASSOC);

if (empty($user))
    echo 1;
else
    echo 2;