<?php
namespace Model;
use PDO;
class Model
{
    protected PDO $pdo;
    public function __construct()
    {
        $this->pdo = new PDO("pgsql:host=database;port=5432;dbname=testdb", "alex", "2612");
    }

}