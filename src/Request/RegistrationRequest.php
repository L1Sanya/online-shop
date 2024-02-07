<?php

namespace Request;

class RegistrationRequest extends Request
{
    public static function validate(array $userInfo) : array
    {
        $errors = [];

        if (empty($userInfo['name'])) {
            $errors['name'] = "Please, complete this field";
        } elseif (strlen($userInfo['name']) < 2) {
            $errors['name'] = "Name length can't be < 2";
        }

        if (empty($userInfo['email'])) {
            $errors['email'] = "Please, complete this field";
        } elseif (filter_var($userInfo['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Invalid email';
        }

        if (empty($userInfo['psw'])) {
            $errors['psw'] = 'Password must be filled';
        } elseif (strlen($userInfo['psw']) < 3) {
            $errors['psw'] = 'Password is too short';
        }

        if (empty($userInfo['psw-repeat'])) {
            $errors['psw-repeat'] = 'Repeat the password';
        } elseif ($userInfo['psw'] !== $userInfo['psw-repeat']) {
            $errors['psw-repeat'] = 'Passwords do not match';
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