<?php

namespace Request;
use l1sanya\MyCore\Request\Request;

class LoginRequest extends Request
{
    public function validate(): array
    {
        $errors = [];

        if (isset($this->body['email'])) {
            $email = $this->body['email'];
        } else {
            $errors['email'] = 'Поле email не указано';
        }
        if (isset($this->body['psw'])) {
            $password = $this->body['psw'];
        } else {
            $errors['psw'] = 'Поле password не указано';
        }

        return $errors;
    }
    public function getName(): string
    {
        return $this->body['name'];
    }

    public function getEmail(): string
    {
        return $this->body['email'];
    }

    public function getPassword(): string
    {
        return $this->body['psw'];
    }
}