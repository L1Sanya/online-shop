<?php

$errors = [];

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    if (empty($name)) {
        $errors['name'] = "Please, complete this field";
    }
    if (strlen($name) < 2) {
        $errors['name'] = "Name length can't be < 2";
    }
} else {
    $errors['name'] = 'EMPTY FIELD';
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if (empty($email)) {
        $errors['email'] = "Please, complete this field";
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Email is not corrected';
    }
} else {
    $errors['email'] = 'EMPTY FIELD';
}

if (isset($_POST['psw'])) {
    $password = $_POST['psw'];
    if (empty($password)) {
        $errors['psw'] = 'Please, complete this field';
    }
    if (strlen($password) < 7) {
        $errors['psw'] = 'Password length can not be < 8';
    }
}else {
    $errors['psw'] = 'EMPTY FIELD';
}

if (isset($_POST['psw-repeat'])) {
    $passwordRepeat = $_POST['psw-repeat'];
    if (empty($passwordRepeat)) {
        $errors['psw-repeat'] = 'Please, complete this field';
    }
    if ($password !== $passwordRepeat) {
        $errors['psw-repeat'] = 'Passwords not similar';
    }
} else {
    $errors['psw-repeat'] = 'EMPTY FIELD';
}

if (empty($errors))
{
    $pdo = new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");

    $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    print_r("Hello {$name}");
} else {
    include_once './get_registrate.php';
}


class UserSignIn
{
    private string $name;
    private string $email;
    private string $password;
    private string $passwordRepeat;

    public function __construct(string $name, string $email, string $password, string $passwordRepeat)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;

    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getPasswordRepeat(): string
    {
        return $this->passwordRepeat;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setPasswordRepeat(string $passwordRepeat): void
    {
        $this->passwordRepeat = $passwordRepeat;
    }

}