<?php

namespace Controller\Api;

use Model\User;

class UserController
{
    public function index()
    {
        $users = User::getAll();

        $users = json_encode($users, JSON_THROW_ON_ERROR);

        return $users;
    }
}