<?php

namespace Service;

use Model\Model;
use Model\Order;
use Model\OrderItem;
use Model\Product;
use Model\UserProduct;
use PDOException;

class OrderService
{
    public function create(int $userId, string $name, string $phone, string $email, string $address, string $comment): void
    {
        $pdo = Model::getPdo();
        $pdo->beginTransaction();

        try {
            $orderId = Order::create($userId, $name, $phone, $email, $address, $comment);
            $products = Product::getProducts($userId);
            $userProducts = UserProduct::getCartProductsByUserId($userId);

            foreach ($userProducts as $userProduct) {
                $product = $products[$userProduct->getId()];
                $productId = $userProduct->getProductId();
                $quantity = $userProduct->getQuantity();
                $total = $product->getPrice() * $userProduct->getQuantity();

                OrderItem::create($orderId, $productId, $quantity, $total);
            }
        } catch (PDOException $exception) {
            $pdo->rollBack();
        }
    }
}