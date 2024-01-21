<?php
session_start();
$_SESSION['user_id'];

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
            $this->getErrors()['email'] = 'Неверный email';
            redirect('/post_login.php');
        } else {
            if ($this->password === $userInfo['password']) {
                redirect('/index.php');
            } else {
                $this->getErrors()['psw'] = "Неверный пароль";
                redirect('/post_login.php');
            }
        }
    }
    public function getErrors(): array
    {
        return $this->errors;
    }
}
