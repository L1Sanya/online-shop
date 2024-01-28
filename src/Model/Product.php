<?php
namespace Model;
use Model\Model;

class Product extends Model
{
    public function getAll() : array
    {
        $stmt = $this->pdo->query('SELECT * FROM products');
        return $stmt->fetchAll();
    }

}