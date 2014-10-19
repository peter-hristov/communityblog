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
class UsersController extends core\controller\Controller
{
    function __construct()
    {
        parent::__construct();
        $this->tableName = "users";
    }

    // To do add capcha, check if user exists , check if password is strong and matches, generate pdf-s
    public function add()
    {

        if (!empty($_POST)) {

            $data = $_POST;
            $errors = $this->registerValidation($data);

            if (!empty($data) && empty($errors)) {

                $token = md5(uniqid(mt_rand() , true));

                $stmt = $this->pdo->prepare("INSERT INTO users (email, password, created, name, gender, birthDate, token, email_confirmed)
                    VALUES ( :email, :password, :created, :name, :gender, :birthDate, :token, :email_confirmed)
                    ");

                $stmt->execute(array(
                    ':email' => $data['email'],
                    ':password' => md5($data['password']) ,
                    ':created' => date('Y-m-d H:i:s') ,
                    ':name' => $data['name'],
                    ':gender' => substr($data['gender'], 0, 1) ,
                    ':birthDate' => $data['birth-year'] . '-' . $data['birth-month'] . '-' . $data['birth-day'],
                    ':token' => $token,
                    ':email_confirmed' => false,
                ));

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

    public function login()
    {
        if (!empty($_POST)) {

            $user = $this->getAll(array(
                'WHERE' => array(
                    'AND' => array(
                        'email' => $_POST['email'],
                        'password' => md5($_POST['password'])
                    )
                ) ,
                'LIMIT' => '1',
            ));

            if (!empty($user)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['Auth'] = $user[0];
            }
            header('Location: /index.php?page=Posts');
            die();
        }
        echo $this->renderView('Users/login');
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('Location: /index.php?page=Posts');
        die();
    }

    public function confirmAccount($option = array())
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
