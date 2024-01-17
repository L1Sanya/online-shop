<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['psw'];
$passwordRepeat = $_POST['psw-repeat'];

$pdo = new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");

$pdo->exec("INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')");
