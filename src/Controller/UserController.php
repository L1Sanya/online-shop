<?php
namespace Controller;
class UserController
{
    public function getRegistrate()
    {
        require_once './../View/get_registrate.phtml';
    }

    public function postRegistrate()
    {
        $errors = $this->validate($_POST);

        if (empty($errors)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['psw'];
            $passwordRep = $_POST['psw-repeat'];

            $hash = password_hash($password, PASSWORD_DEFAULT);
            try {
                require './../Model/User.php';
                $userModel = new User();
                $userModel->insertData($name, $email, $hash);

                header('Location: /login');
            } catch (PDOException){
                $errors['email'] = "Пользователь с таким email уже существует";
            }

        }
        require_once './../View/get_registrate.phtml';
    }
    private function validate(array $userInfo) : array
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

    public function getLogin()
    {
        require_once './../View/get_login.phtml';
    }

    public function postLogin()
    {

        $errors = [];

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        if (isset($_POST['psw'])) {
            $password = $_POST['psw'];
        }

        require './../Model/User.php';
        $userModel = new User();
        $userInfo = $userModel->getData($email);

        if (empty($userInfo)) {
            $errors['email'] = 'Неверный email';
        } else {
            if (password_verify($password, $userInfo['password'])) {
                session_start();
                $_SESSION['user_name'] = $userInfo['name'];
                $_SESSION['user_email'] = $userInfo['email'];
                $_SESSION['user_id'] = $userInfo['id'];
                header('Location: /main');
            } else {
                $errors['psw'] = "Неверный пароль";
            }
        }
        require_once './../View/get_login.phtml';
    }
    public function logout(): void {
        unset($_SESSION['user']['id']);
        $this->redirect('/login');
    }
    public function redirect(string $path){
        header("Location: $path");
        die();
    }
}