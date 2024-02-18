<?php
namespace Controller;
use Model\User;
use PDOException;
use Request\LoginRequest;
use Request\RegistrationRequest;
use Service\Authentication\AuthenticationServiceInterface;
use Service\Authentication\SessionAuthenticationService;
use Service\Service;

class UserController
{
    private AuthenticationServiceInterface $authenticationService;

    public function __construct(AuthenticationServiceInterface $sessionAuthenticationService)
    {
        $this->authenticationService = $sessionAuthenticationService;
    }

    public function getRegistration(): void
    {
        require_once './../View/registration.phtml';
    }

    public function registration(RegistrationRequest $request): void
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
        require_once './../View/registration.phtml';
    }

    public function getLogin(): void
    {
        require_once './../View/login.phtml';
    }

    public function login(LoginRequest $request): void
    {

        $errors = $request->validate();

        if (empty($errors)) {

            $email = $request->getEmail();
            $password = $request->getPassword();

            $user = User::getOneByEmail($email);

            $result = $this->authenticationService->login($password, $email);

            if ($result) {
                header("Location: /main");
            } else {
                $errors['email'] = 'Invalid password or email';
            }
        }
        require_once './../View/login.phtml';
    }

    public function logout(): void
    {
        $this->authenticationService->logout();

        header('Location: /login');
    }

}