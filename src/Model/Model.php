<?php
namespace Model;
use PDO;
class Model
{
    protected static PDO $pdo;

    public static function getPdo() : PDO
    {
        if (!isset(static::$pdo)){
            static::initialize();
        }

        return static::$pdo;
    }

    public static function initialize() : void
    {
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_DATABASE');
        $username= getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        $port = getenv('DB_PORT');
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        static::$pdo = new PDO("pgsql:host=$host; port=$port; dbname=$dbname", "$username", "$password", $options);
    }

    protected static function prepareExecute(string $sql, array $data): false|\PDOStatement
    {
        $stmt = static::getPDO()->prepare($sql);

        foreach ($data as $param => $value)
        {
            $stmt->bindValue(":$param", $value);

        }
        $stmt->execute();

        return $stmt;

    }

}