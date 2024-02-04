<?php

namespace Request;

class RegistrationRequest extends Request
{
   public static function validate(array $userInfo) : array
    {
        $errors = [];

        if (isset($userInfo['name'])) {
            $name = $userInfo['name'];
            if (empty($name)) {
                $errors['name'] = "Please, complete this field";
            }
            if (strlen($name) < 2) {
                $errors['name'] = "Name length can't be < 2";
            }
        } else {
            $errors['name'] = 'Empty Field';
        }

        if (isset($userInfo['email'])) {
            $email = $userInfo['email'];
            if (empty($email)) {
                $errors['email'] = "Please, complete this field";
            }
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'Invalid email';
            }
        } else {
            $errors['email'] = 'EMPTY FIELD';
        }

        if (isset($userInfo['psw'])) {
            $password = $userInfo['psw'];
            if (empty($password)) {
                $errors['psw'] = 'Пароль должен быть заполнен';
            }
            if (strlen($password) < 3) {
                $errors['psw'] = 'Пароль слишком короткий';
            }
        } else {
            $errors['psw'] = 'Поле password не указано';
        }

        if (isset($userInfo['psw-repeat'])) {
            $passwordRep = $userInfo['psw-repeat'];
            if (empty($passwordRep)) {
                $errors['psw-repeat'] = 'Повторите пароль';
            }
            if ($password !== $passwordRep) {
                $errors['psw-repeat'] = 'Пароли должны совпадать';
            }
        } else {
            $errors['psw-repeat'] = 'Поле repeat password не указано';
        }
        return $errors;
    }
}