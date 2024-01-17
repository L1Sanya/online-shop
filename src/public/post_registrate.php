<?php

$name = $_POST['name'];
if (isset($_POST['name']))
{
    $name = $_POST['name'];
}

if (empty($name))
{
    echo 'Имя должно быть заполнено';
}

if (strlen($name) < 2)
{
    echo 'Имя должно быть больше 2 символов';
}

$email = $_POST['email'];


$password = $_POST['psw'];
$passwordRepeat = $_POST['psw-repeat'];


$pdo = new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");

$stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password');
$stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);



$pdo->exec("INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')");
