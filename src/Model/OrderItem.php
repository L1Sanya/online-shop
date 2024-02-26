<?php

namespace Model;

use l1sanya\MyCore\Model\Model;

class OrderItem extends Model
{
    public static function create(int $orderId, int $productId, int $quantity, int $totalPrice) : void
    {
        $stmt = static::getPdo()->prepare("INSERT INTO order_items (order_id, product_id, quantity, total_price) VALUES (:orderId, :productId, :quantity, :total)");
        $stmt->execute(['orderId' => $orderId, 'productId' => $productId, 'quantity' => $quantity, 'total' => $totalPrice]);
    }

}