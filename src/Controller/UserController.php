<?php
namespace Controller;
use Model\User;
use PDOException;
use Service\Service;
use Request\RegistrationRequest;
class UserController
{
    public function getRegistrate()
    {
        require_once './../View/get_registrate.phtml';
    }

    public function postRegistrate()
    {
        $errors = RegistrationRequest::validate($_POST);

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

                Service::redirect('Location: /login');
            } catch (PDOException){
                $errors['email'] = "Пользователь с таким email уже существует";
            }

        }
        require_once './../View/get_registrate.phtml';
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

        $user = User::getOneByEmail($email);

        if (empty($user)) {
            $errors['email'] = 'Неверный email';
        } else {
            if (password_verify($password, $user->getPassword())) {
                session_start();
                $_SESSION['user_name'] = $user->getName();
                $_SESSION['user_email'] = $user->getEmail();
                $_SESSION['user_id'] = $user->getId();
                Service::redirect('/main');
            } else {
                $errors['psw'] = "Неверный пароль";
            }
        }
        require_once './../View/get_login.phtml';
    }
    public function logout(): void {
        unset($_SESSION['user']['id']);
        Service::redirect('/login');
    }
}