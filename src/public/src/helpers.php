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


class DatabaseHandler
{
    public static function addUser($input): void
    {
        $input->validate();

        if (empty($input->getErrors())) {
            $pdo = getPDO();
            if ($pdo !== null) {
                $stmt = $pdo->prepare('INSERT INTO users (name, email, hashPassword) VALUES (:name, :email, :hashPassword)');
                $stmt->execute(['name' => $input->getName(), 'email' => $input->getEmail(), 'hashPassword' => hash('sha256',$input->getPassword())]);

                $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
                $stmt->execute(['email' => $input->getEmail()]);

                redirect('/get_login.php');

            } else {
                require_once '/actions/registration_failed.php';
            }
            //redirect("/home.php");
        } else {

            require_once './get_registrate.php';
        }
    }

}