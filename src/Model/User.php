<?php
namespace Model;

use JsonSerializable;
use l1sanya\MyCore\Model\Model;

class User extends Model implements JsonSerializable
{
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $password;

    public function __construct(?int $id = null, ?string $name = null, ?string $email = null, ?string $password = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function addUserData(string $name, string $email, string $hash) : void
    {
        $stmt = static::getPdo()->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :hash)");
        $stmt->execute(['name' => $name, 'email' => $email, 'hash' => $hash]);
    }

    public static function getOneByEmail($email): ?User
    {
        $stmt = static::getPdo()->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch();
        if (empty($data)) {
            return null;
        }
        return new User($data['id'], $data['name'], $data['email'], $data['password']);
    }
    public static function getOneById($id): ?User
    {
        $stmt = static::getPdo()->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        if (empty($data)) {
            return null;
        }
        return new User($data['id'], $data['name'], $data['email'], $data['password']);
    }

    public static function getAll(): ?User
    {
        $stmt = self::getPdo()->query('SELECT * FROM users');
        $data = $stmt->fetchAll();

        if (empty($data)) {
            return null;
        }

        return new User($data['id'], $data['name'], $data['email'], $data['password']);
    }

    public function jsonSerialize() : array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}