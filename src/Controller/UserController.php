<?php
namespace Controller;
use JetBrains\PhpStorm\NoReturn;
use Model\User;
use PDOException;
use Request\LoginRequest;
use Request\Request;
use Service\Service;
use Service\SessionAuthenticationService;
use Request\RegistrationRequest;
class UserController
{
    private SessionAuthenticationService $sessionAuthenticationService;

    public function __construct(SessionAuthenticationService $sessionAuthenticationService)
    {
        $this->sessionAuthenticationService = $sessionAuthenticationService;
    }

    public function getRegistration(): void
    {
        require_once './../View/registrate.phtml';
    }

    public function postRegistration(RegistrationRequest $request): void
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

                header('Location: /login');
            } catch (PDOException) {
                $errors['email'] = "Пользователь с таким email уже существует";
            }

        }
        require_once './../View/registrate.phtml';
    }

    public function getLogin(): void
    {
        require_once './../View/login.phtml';
    }

    public function postLogin(LoginRequest $request): void
    {

        $errors = $request->validate();

        if (empty($errors)) {

            $email = $request->getEmail();
            $password = $request->getPassword();

            $user = User::getOneByEmail($email);

            $result = $this->sessionAuthenticationService->login($password, $email);

            if ($result) {
                header("Location: /main");
            } else {
                $errors['email'] = 'Invalid password or email';
            }
        }
        require_once './../View/login.phtml';
    }
    public function getOrder(): void
    {
        require_once './../View/order.phtml';
    }

}