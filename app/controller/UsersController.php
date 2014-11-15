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
use app\model\Ubermodel as Ubermodel;
use app\helper\UsersHelper as UsersHelper;

class UsersController extends \core\controller\Controller
{

    const LOGIN_TYPE_APP = 1;
    const LOGIN_TYPE_FB = 2;

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

            if (empty($errors)) {

                $data['email_confirmed'] = false;
                $data['token'] = md5(uniqid(mt_rand() , true));
                $data['login_type'] = self::LOGIN_TYPE_APP;
                $data['birth_date'] = $data['birth_year'] . '-' . $data['birth_month'] . '-' . $data['birth_day'];

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
        $fbUserProfile = \core\wrapper\FacebookWrapper::getUserProfileFromRedirect();

        $data = array(
            'fb_id' => $fbUserProfile->getId(),
            'login_type' => self::LOGIN_TYPE_FB,
            'email' => $fbUserProfile->getEmail(),
            'created' => date('Y-m-d H:i:s'),
            'name' => $fbUserProfile->getName(),
            'gender' => 'unisex',
            'birth_date' => 'n/a',
            'token' => null,
            'email_confirmed' => true
        );

        $fbLogin = Ubermodel::getAll(array('tableName' => 'fb_logins', 'WHERE' => array('fb_id' => $data['fb_id'])));

        if (empty($fbLogin))
            $this->addNewUser($data);
        else
            $this->_login($data);

        header('Location: /index.php?page=Posts');
        die();
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
        $data['login_type'] = self::LOGIN_TYPE_APP;

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

    private function addNewUser( $data )
    {
        // Making a new app_login
        if ( $data['login_type'] == self::LOGIN_TYPE_APP) {
            $stmt = Ubermodel::$pdo->prepare("INSERT INTO app_logins (name, password) VALUES ( :name, :password)");

            $stmt->execute(array(
                ':name' => $data['email'],
                ':password' => md5($data['password'])
            ));
        }

        else if ( $data['login_type'] == self::LOGIN_TYPE_FB) {
            $stmt = Ubermodel::$pdo->prepare("INSERT INTO fb_logins (fb_id) VALUES ( :fb_id)");

            $stmt->execute(array(
                ':fb_id' => $data['fb_id']
            ));
        }

        $loginId = Ubermodel::$pdo->lastInsertId();

        $stmt = Ubermodel::$pdo->prepare("INSERT INTO users (login_id, login_type, email, created, name, gender, birth_date, token, email_confirmed)
            VALUES ( :login_id, :login_type, :email, :created, :name, :gender, :birth_date, :token, :email_confirmed)
            ");

        $stmt->execute(array(
            ':login_id' => $loginId,
            ':login_type' => $data['login_type'],
            ':email' => $data['email'],
            ':created' => date('Y-m-d H:i:s') ,
            ':name' => $data['name'],
            ':gender' => substr($data['gender'], 0, 1) ,
            ':birth_date' => $data['birth_date'],
            ':token' => $data['token'],
            ':email_confirmed' => $data['email_confirmed'],
        ));

        $this->_login($data);
    }

    private function _login( $data )
    {
        echo $data['login_type'];

        if ( $data['login_type'] == self::LOGIN_TYPE_APP) {

            $statement = Ubermodel::$pdo->prepare('
                SELECT users.*
                FROM users
                Inner JOIN app_logins
                ON app_logins.id = users.login_id
                WHERE users.email = :email AND app_logins.password = :password AND users.login_type = :login_type
            ');

            $statement->execute(array(
                ':email' => $data['email'],
                ':password' => md5($data['password']),
                ':login_type' => self::LOGIN_TYPE_APP
            ));
        }

        else if ( $data['login_type'] == self::LOGIN_TYPE_FB) {

            $statement = Ubermodel::$pdo->prepare('
                SELECT users.*
                FROM users
                Inner JOIN fb_logins
                ON fb_logins.id = users.login_id
                WHERE fb_logins.fb_id = :fb_id AND users.login_type = :login_type
            ');

            $statement->execute(array(
                ':fb_id' => $data['fb_id'],
                ':login_type' => self::LOGIN_TYPE_FB
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
                $stmt = Ubermodel::$pdo->prepare("UPDATE users SET email_confirmed=1 WHERE id=" . $user['id'])->execute();
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





        $statement = Ubermodel::$pdo->prepare('select * from users where token=:x');
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
        }

        $x = Ubermodel::getOne($this->tableName, 'email', $data['email']);
        if (!empty($x)) {
            $errors['clone'] = true;
        }

        // Regex taken from http://stackoverflow.com/questions/13384008/php-regex-password-validation-not-working
        if (!empty($data['password']) && !preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/", $data['password'])){
            $errors['password'] = true;

            if($data['password'] != $data['repassword']) {
                $errors['repassword'] = true;

            }
        }
        if (!empty($data['gender']) && !($data['gender'] === 'male' || $data['gender'] === 'female')) {
            $errors['gender'] = true;
        }
        if (!empty($data['birth_day']) && !($data['birth_day'] >= 1 && $data['birth_day'] <= 31)) {
            $errors['birth_day'] = true;
        }
        if (!empty($data['birth_month']) && !($data['birth_month'] >= 1 && $data['birth_month'] <= 12)) {
            $errors['birth_month'] = true;
        }
        if (!empty($data['birth_year']) && !($data['birth_year'] >= 1900 && $data['birth_year'] <= 2014)) {
            $errors['birth_year'] = true;
        }

        // $captcha = \core\wrapper\CaptchaWrapper::createCaptcha(__ENVIRONMENT__);
        // $response = $captcha->check($_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);

        // if (!$response->isValid())
        // {
        //     $errors['captcha'] = true;
        // }

        return $errors;
    }
}
