<?php
namespace Controller;
use JetBrains\PhpStorm\NoReturn;
use Model\User;
use PDOException;
use Request\LoginRequest;
use Request\Request;
use Service\Service;
use Service\SessionAutenticationService;
use Request\RegistrationRequest;
class UserController
{
    public function getRegistrate(): void
    {
        require_once './../View/get_registrate.phtml';
    }
    public function postRegistrate(RegistrationRequest $request): void
    {
        $errors = RegistrationRequest::validate($_POST);

        if (empty($errors)) {
            $name = $request->getName();
            $email = $request->getEmail();
            $password = $request->getPassword();

            $hash = password_hash($password, PASSWORD_DEFAULT);
            try {
                require './../Model/User.php';
                $userModel = new User();
                $userModel->addUserData($name, $email, $hash);

                Service::redirect('Location: /login');
            } catch (PDOException){
                $errors['email'] = "Пользователь с таким email уже существует";
            }

        }
        require_once './../View/get_registrate.phtml';
    }

    public function getLogin(): void
    {
        require_once './../View/get_login.phtml';
    }

    public function postLogin(LoginRequest $request): void
    {

        $errors = $request->validate();

        if (empty($errors)) {

            $email = $request->getEmail();
            $password = $request->getPassword();

            $user = User::getOneByEmail($email);

            if (empty($user)) {
                $errors['email'] = 'Неверный email';
            } else {
                if (password_verify($password, $user->getPassword())) {
                    session_start();
                    $_SESSION['user_name'] = $user->getName();
                    $_SESSION['user_email'] = $user->getEmail();
                    $_SESSION['user_id'] = $user->getId();
                    header('Location: /main');
                } else {
                    $errors['psw'] = "Неверный пароль";
                }
            }
            require_once './../View/get_login.phtml';
        }
    }
}