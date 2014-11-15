<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - add()
 * - login()
 * - logout()
 * - confirmAccount()
 * - processToken()
 * - registerValidation()
 * Classes list:
 * - UsersController extends core
 */
namespace app\controller;

class UsersController extends \core\controller\Controller
{
    function __construct()
    {
        parent::__construct();
        $this->tableName = "users";
    }

    public function add()
    {
        if (!empty($_POST)) {

            $data = $_POST;
            $errors = $this->registerValidation($data);

            if (!empty($data) && empty($errors)) {

                $data['token'] = md5(uniqid(mt_rand() , true));
                $data['email_confirmed'] = false;
                $data['login_type'] = 1;
                $data['birthDate'] = $data['birth-year'] . '-' . $data['birth-month'] . '-' . $data['birth-day'];

                $this->addNewUser($data);

                // Sending Token
                $this->mailer->sendEmail('admin@partylpant.eu', $data['email'], 'PartyPlant Account Confirmation',
                    '<p> Hello, please follow this link to confirm your account : </p>
                    <a href=http://'.__SITENAME__.'/index.php?page=Users&action=confirmAccount&token=' . $token .' > Click Here </a>'
                    );

                header('Location: /index.php?page=Posts');
                die();
            }
        }

        echo $this->renderView('Users/add', compact('data', 'errors'));
    }


    public function blqLogin()
    {

        $user_profile = \core\wrapper\FacebookWrapper::getUserProfileFromRedirect();

        $data = array(
            'fb_id' => $user_profile->getId(),
            'login_type' => 2,
            'email' => $user_profile->getEmail(),
            'created' => date('Y-m-d H:i:s'),
            'name' => $user_profile->getName(),
            'gender' => 'unisex',
            'birthDate' => 'n/a',
            'token' => null,
            'email_confirmed' => true
        );

        $x = $this->getAll(array('tableName' => 'fb_logins', 'WHERE' => array('fb_id' => $data['fb_id'])));

        if ( empty($x) )
            $this->addNewUser($data);
        else
            $this->_login($data);

        header('Location: /index.php?page=Posts');
        die();
    }

    private function addNewUser( $data )
    {
        // Making a new app_login
        if ( $data['login_type'] == 1) {
            $stmt = $this->pdo->prepare("INSERT INTO app_logins (name, password) VALUES ( :name, :password)");

            $stmt->execute(array(
                ':name' => $data['email'],
                ':password' => md5($data['password'])
            ));
        }

        else if ( $data['login_type'] == 2) {
            $stmt = $this->pdo->prepare("INSERT INTO fb_logins (fb_id) VALUES ( :fb_id)");

            $stmt->execute(array(
                ':fb_id' => $data['fb_id']
            ));
        }

        $loginId = $this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare("INSERT INTO users (login_id, login_type, email, created, name, gender, birthDate, token, email_confirmed)
            VALUES ( :login_id, :login_type, :email, :created, :name, :gender, :birthDate, :token, :email_confirmed)
            ");

        $stmt->execute(array(
            ':login_id' => $loginId,
            ':login_type' => $data['login_type'],
            ':email' => $data['email'],
            ':created' => date('Y-m-d H:i:s') ,
            ':name' => $data['name'],
            ':gender' => substr($data['gender'], 0, 1) ,
            ':birthDate' => $data['birthDate'],
            ':token' => $data['token'],
            ':email_confirmed' => $data['email_confirmed'],
        ));

        $this->_login($data);
    }

    public function login()
    {
        if (empty($_POST)) {
            echo $this->renderView('Users/login');
            return;
        }

        $data = array();
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];
        $data['login_type'] = 1;

        $this->_login($data);

        header('Location: /index.php?page=Posts');
        die();
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('Location: /index.php?page=Posts');
        die();
    }

    private function _login( $data )
    {
        if ( $data['login_type'] == 1) {

            $statement = $this->pdo->prepare('
                SELECT users.*
                FROM users
                Inner JOIN app_logins
                ON app_logins.id = users.login_id
                WHERE users.email = :email AND app_logins.password = :password
            ');

            $statement->execute(array(
                ':email' => $data['email'],
                ':password' => md5($data['password'])
            ));
        }

        else if ( $data['login_type'] == 2) {

            $statement = $this->pdo->prepare('
                SELECT users.*
                FROM users
                Inner JOIN fb_logins
                ON fb_logins.id = users.login_id
                WHERE fb_logins.fb_id = :fb_id
            ');

            $statement->execute(array(
                ':fb_id' => $data['fb_id']
            ));
        }

        $user = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!empty($user)) {

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['Auth'] = $user;
        }
    }

    private function confirmAccount($option = array())
    {
        $user = $this->processToken($option['token']);

        if (isset($user)) {

            if ($user['email_confirmed'] == 0) {
                $stmt = $this->pdo->prepare("UPDATE users SET email_confirmed=1 WHERE id=" . $user['id'])->execute();
                echo $this->renderView('Users/confirmed');
            } else {
                echo $this->renderView('Users/already_confirmed');
            }
        } else {
            echo $this->renderView('Users/rejected');
        }
    }

    private function processToken($token)
    {
        if (empty($token)) return null;

        $statement = $this->pdo->prepare('select * from users where token=:x');
        $statement->execute(array(
            ':x' => $token
        ));
        $user = $statement->fetch(\PDO::FETCH_ASSOC);

        if (empty($user)) return null;

        return $user;
    }

    private function registerValidation($data = array())
    {
        if (empty($data)) return array();

        $errors = array();

        if (!empty($data['name']) && !preg_match('/^[a-z][a-z ]*$/i', $data['name'])) {
            $errors['name'] = true;
        }
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = true;

            $x = $this->getOne('email', $data['email']);
            if (!empty($x)) {
                $errors['clone'] = true;
            }
        }
        if (!empty($data['password']) && !empty($data['rePassword']) && $data['password'] != $data['rePassword']) {
            $errors['rePassword'] = true;
        }
        // Regex taken from http://stackoverflow.com/questions/13384008/php-regex-password-validation-not-working
        if (!empty($data['password']) && !preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/", $data['password'])){
            $errors['password'] = true;
        }
        if (!empty($data['gender']) && !($data['gender'] === 'male' || $data['gender'] === 'female')) {
            $errors['gender'] = true;
        }
        if (!empty($data['birth-day']) && !($data['birth-day'] >= 1 && $data['birth-day'] <= 31)) {
            $errors['birth-day'] = true;
        }
        if (!empty($data['birth-month']) && !($data['birth-month'] >= 1 && $data['birth-month'] <= 12)) {
            $errors['birth-month'] = true;
        }
        if (!empty($data['birth-year']) && !($data['birth-year'] >= 1900 && $data['birth-year'] <= 2014)) {
            $errors['birth-year'] = true;
        }

        $captcha = \core\wrapper\CaptchaWrapper::createCaptcha(__ENVIRONMENT__);
        $response = $captcha->check($_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);

        if (!$response->isValid())
        {
            $errors['captcha'] = true;
        }

        return $errors;
    }
}
