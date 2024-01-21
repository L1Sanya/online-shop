<?php

function getPDO(): ?PDO
{
    $pdo = null;
    try {
        $pdo = new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");
    } catch (Exception $e) {
        echo "Connection failed";
    }
    return new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");
}
function logout(): void{
    unset($_SESSION['user']['id']);
    redirect('/.php');
}


function redirect(string $path){
    header("Location: $path");
    die();
}

function checkName(string $name): bool
{
    $string = "!@#$%^&*()-=[]{}/><,.';:\|";
    for ($i = 0; $i < strlen($name); $i++) {
        for ($j = 0; $j < strlen($string); $j++) {
            if ($name[$i] === $string[$j]){
                return false;
            }
        }
    }
    return true;
}


class DatabaseHandler
{
    public static function addUser($input): void
    {
        $input->validate();

        if (empty($input->getErrors())) {
            $pdo = getPDO();
            if ($pdo !== null) {
                require_once './registration_successful.php';
                $stmt = $pdo->prepare('INSERT INTO users (name, email, password, hashPassword) VALUES (:name, :email, :password, :hashPassword)');
                $stmt->execute(['name' => $input->getName(), 'email' => $input->getEmail(), 'password' => $input->getPassword(),'hashPassword' => hash('sha256',$input->getPassword())]);

                $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
                $stmt->execute(['email' => $input->getEmail()]);

                print_r("\n Hello, {$input->getName()}");
            } else {
                require_once './registration_failed.php';
            }
            //redirect("/home.php");
        } else {
            //redirect("https://vk.com/l1sanya");
            require_once './get_registrate.php';
        }
    }
}