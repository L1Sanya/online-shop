<?php
namespace Service;
use JetBrains\PhpStorm\NoReturn;
use Model\User;

class SessionAutenticationInterface implements AutenticationInterface
{
    public function check(): bool
    {
        session_start();
        return isset($_SESSION['user_id']);
    }
    public function logout(): void
    {
        session_start();
        unset($_SESSION['user_id']);
        session_destroy();
    }


    public function getCurrentUser():
    {

    }

    public function login(string $password, string $email): bool
    {

    }
}