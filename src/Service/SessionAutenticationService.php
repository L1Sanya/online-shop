<?php
namespace Service;
use JetBrains\PhpStorm\NoReturn;
use Model\User;

class SessionAutenticationService implements AutenticationService
{
    public function check(): bool
    {
        session_start();
        return isset($_SESSION['user_id']);
    }
    
}