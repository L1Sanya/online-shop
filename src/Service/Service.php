<?php
namespace Service;
use JetBrains\PhpStorm\NoReturn;

class Service
{
    #[NoReturn] public function logout(): void
    {
        unset($_SESSION['user']['id']);
        $this->redirect('/login');
    }
    #[NoReturn] public static function redirect(string $path): void
    {
        header("Location: $path");
        die();
    }
    public static function checkCurrentSession(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            Service::redirect('/login');
        }
    }

}