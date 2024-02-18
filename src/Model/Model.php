<?php
namespace Model;
use PDO;
class Model
{
    protected static PDO $pdo;

    public static function getPdo() : PDO
    {
        self::$pdo = new PDO("pgsql:host=database; port=5432; dbname=testdb", "alex", "2612");

        return self::$pdo;
    }

    protected static function prepareExecute(string $sql, array $data): false|\PDOStatement
    {
        $stmt = self::getPDO()->prepare($sql);

        foreach ($data as $param => $value)
        {
            $stmt->bindValue(":$param", $value);

        }
        $stmt->execute();

        return $stmt;

    }

}