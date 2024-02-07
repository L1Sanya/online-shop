<?php

namespace Service;

class CookieAutenticateInterface implements AutenticationInterface
{
    public function check(): bool
    {
        return isset($_COOKIE['user_id']);
    }
    public function getCurrentUser():
    {

    }
    public function login(string $password, string $email): bool
    {

    }
    public function logout(): void
    {
        session_start();
        unset($_COOKIE['user_id']);
        session_destroy();
    }
}