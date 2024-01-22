<?php
require_once __DIR__ . '/src/helpers.php';

$input = new Auth(
    $_POST['email'],
    $_POST['psw']
);

$input->authenticate($input);






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

    public function authenticate($input):void {
        $pdo = new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $input->email]);
        $userInfo = $stmt->fetch();

        if (empty($userInfo)) {
            $input->errors['email'] = 'Пользователя с таким Email не существует';
            require_once './get_login.php';
        } else {
            if (hash('sha256', $input->password) === $userInfo['hashpassword']) {
                session_start();
                $_SESSION['user_name'] = $userInfo['name'];
                $_SESSION['user_email'] = $userInfo['email'];
                $_SESSION['user_id'] = $userInfo['id'];
                redirect('./main.php');
            } else {
                    $input->errors['psw'] = "Неверный пароль";
                require_once './get_login.php';
            }
        }

    }
    public function getErrors(): array
    {
        return $this->errors;
    }

}
