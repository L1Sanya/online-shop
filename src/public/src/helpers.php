<?php

session_start();


function getPDO(): void
{
    $pdo = new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");
}
function logout(): void
{
    unset($_SESSION['user']['id']);
    redirect('/.php');
}
function redirect(string $path)
{
    header("Location: $path");
    die();
}

