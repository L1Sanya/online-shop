<?php

namespace Service;

use Model\Model;
use Model\Order;
use Model\OrderItem;
use Model\Product;
use Model\UserProduct;
use Throwable;

class OrderService
{
    /**
     * @throws Throwable
     */
    public function create(int $userId, string $name, string $phone, string $email, string $address, string $comment): void
    {
        $pdo = Model::getPdo();
        $products = Product::getProducts($userId);
        $userProducts = UserProduct::getCartProductsByUserId($userId);
        $pdo->beginTransaction();
        try {
            $orderId = Order::create($userId, $name, $phone, $email, $address, $comment);

            foreach ($userProducts as $userProduct) {
                $product = $products[$userProduct->getId()];
                $productId = $userProduct->getProductId();
                $quantity = $userProduct->getQuantity();
                $total = $product->getPrice() * $userProduct->getQuantity();

                OrderItem::create($orderId, $productId, $quantity, $total);
            }
            $pdo->commit();
        } catch (Throwable $exception) {
            $pdo->rollBack();
            LoggerService::error($exception);

            require_once "./../View/500.html";
        }
    }
}