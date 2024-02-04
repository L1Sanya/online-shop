<?php
namespace Service;
use JetBrains\PhpStorm\NoReturn;

class Service
{
    #[NoReturn] public function logout(): void {
        unset($_SESSION['user']['id']);
        $this->redirect('/.php');
    }
    #[NoReturn] public static function redirect(string $path): void
    {
        header("Location: $path");
        die();
    }

}