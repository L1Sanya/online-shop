<?php
namespace Controller;
use Model\User;
use PDOException;
use Request\LoginRequest;
use Request\RegistrationRequest;
use Traits\ControllerTrait;

class UserController
{
    use ControllerTrait;

    public function getRegistration(): string
    {
        return $this->viewRenderer->render('registration.phtml', [], true);
    }

    public function registration(RegistrationRequest $request) : string
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
        return $this->viewRenderer->render('registration.phtml', ['errors' => $errors], true);
    }

    public function getLogin(): string
    {
        return $this->viewRenderer->render('login.phtml', [], true);
    }

    public function login(LoginRequest $request): string
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
        return $this->viewRenderer->render('login.phtml', ['errors' => $errors], true);
    }

    public function logout(): void
    {
        $this->authenticationService->logout();

        header('Location: /login');
    }

}