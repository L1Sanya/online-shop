<?php
//session_start();
//$_SESSION['user_id'];

require_once __DIR__ . '/src/helpers.php';


$input = new Auth(
    $_POST['email'],
    $_POST['psw']
);

$input->authenticate();






class Auth{

    private string $email;
    private string $password;

    private array $errors;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->errors = [];
    }

    public function authenticate():void {
        $pdo = new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $this->email]);
        $userInfo = $stmt->fetch();

        if (empty($userInfo)) {
            require_once './get_login.php';
            $this->getErrors()['email'] = 'Пользователя с таким Email не существует';
            if (isset($this->email)) {
                if (empty($this->email)) {
                    $this->errors['email'] = "Please, complete this field";
                }
            }
        } else {
            if (hash('sha256',$this->password) === $userInfo['hashpassword']) {
                session_start();
                $_SESSION['user_name'] = $userInfo['name'];
                $_SESSION['user_email'] = $userInfo['email'];
                $_SESSION['user_id'] = $userInfo['id'];
                redirect('./main.php');
            } else {
                $this->getErrors()['psw'] = "Неверный пароль или email";
            }
        }
    }
    public function getErrors(): array
    {
        return $this->errors;
    }
}
