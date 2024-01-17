<?php
$pdo = new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");


$validationError = false;


if (isset($_POST['name']))
{
    $name = $_POST['name'];
}

if (empty($name))
{
    echo 'Имя должно быть заполнено';
    $validationError = true;
}

if (strlen($name) < 2)
{
    echo 'Имя должно быть больше 2 символов';
    $validationError = true;
}


if (isset($_POST['email']))
{
    $email = $_POST['email'];
}

if (empty($email))
{
    echo 'email должно быть заполнено';
    $validationError = true;
}

if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
{
    echo 'Email указан не правильно';
    $validationError = true;
}


if (isset($_POST['psw']))
{
    $password = $_POST['psw'];
}

if (empty($password))
{
    echo 'Пароль должен быть заполнен';
    $validationError = true;
}

if (strlen($password) < 7)
{
    echo 'Пароль должен быть длинной не менее 8 символов';
    $validationError = true;
}

$passwordRepeat = $_POST['psw-repeat'];

if ($password !== $passwordRepeat)
{
    echo 'Пароль не совпадает';
    $validationError = true;
}

if ($validationError === false)
{
    $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
    $stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
    $data = $stmt->fetchAll();
    print_r($data);
}
