<?php
class Service
{
    public function logout(): void {
        unset($_SESSION['user']['id']);
        redirect('/.php');
    }
    public function redirect(string $path){
        header("Location: $path");
        die();
    }
    public function getPDO(): ?PDO
    {
        $pdo = null;
        try {
            $pdo = new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");
        } catch (Exception $e) {
            echo "Connection failed";
        }
        return new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");
    }
}