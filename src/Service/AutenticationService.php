<?php

namespace Service;

interface AutenticationService
{
    public function check(): bool;
    public function logout(): void;
    public function login(): void;
}