<?php
require __DIR__ . '/src/helpers.php';

$input = new Input(
    $_POST['name'],
    $_POST['email'],
    $_POST['psw'],
    $_POST['psw-repeat']
);

DatabaseHandler::addUser($input);

class Input
{
    private string $name;
    private string $email;
    private string $password;
    private string $passwordRepeat;

    private array $errors;

    public function __construct(string $name, string $email, string $password, string $passwordRepeat)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
        $this->errors = [];

    }

    public function validate(): void
    {
        //require_once __DIR__ . '/src/helpers.php';

        if (isset($this->name)) {

            if (empty($this->name)) {
                $this->errors['name'] = "Please, complete this field";
            }
            if (strlen($this->name) < 2) {
                $this->errors['name'] = "Name length can't be < 2";
            }
            if (!$this->checkName($this->name)) {
                $this->errors['name'] = 'Illegal characters';
            }
        } else {
            $this->errors['name'] = 'EMPTY FIELD';
        }

        if (isset($this->email)) {

            if (empty($this->email)) {
                $this->errors['email'] = "Please, complete this field";
            }
            if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
                $this->errors['email'] = 'Invalid email';
            }
        } else {
            $this->errors['email'] = 'EMPTY FIELD';
        }

        if (isset($this->password)) {

            if (empty($this->password)) {
                $this->errors['psw'] = 'Please, complete this field';
            }
            if (strlen($this->password) < 7) {
                $this->errors['psw'] = 'Password length can not be < 8';
            }
        }else {
            $this->errors['psw'] = 'EMPTY FIELD';
        }

        if (isset($this->passwordRepeat)) {

            if (empty($this->passwordRepeat)) {
                $this->errors['psw-repeat'] = 'Please, complete this field';
            }
            if ($this->password !== $this->passwordRepeat) {
                $this->errors['psw-repeat'] = 'Passwords not similar';
            }
        } else {
            $this->errors['psw-repeat'] = 'EMPTY FIELD';
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPasswordRepeat(): string
    {
        return $this->passwordRepeat;
    }

    public function setPasswordRepeat(string $passwordRepeat): void
    {
        $this->passwordRepeat = $passwordRepeat;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }
    public function checkName($name): bool {
        $string = "!@#$%^&*()-=[]{}/><,.';:\|";
        for ($i = 0; $i < strlen($this->name); $i++) {
            for ($j = 0; $j < strlen($string); $j++) {
                if ($this->name[$i] === $string[$j]){
                    return false;
                }
            }
        }
        return true;
    }

}



