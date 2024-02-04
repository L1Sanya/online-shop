<?php
namespace Model;
use PDO;
abstract class Model
{
    private static PDO $pdo;
    public static function getPdo() : PDO {
        self::$pdo = new PDO("pgsql:host=database; port=5432; dbname=testdb", "alex", "2612");

        return self::$pdo;
    }

}