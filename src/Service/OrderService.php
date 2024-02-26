<?php

namespace Service;

use l1sanya\MyCore\Logger\LoggerService;
use Model\Order;
use Model\OrderItem;
use Model\Product;
use Model\UserProduct;
use PDO;
use Throwable;

class OrderService
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(int $userId, string $name, string $phone, string $email, string $address, string $comment): bool
    {

        $products = Product::getProducts($userId);
        $userProducts = UserProduct::getCartProductsByUserId($userId);
        $this->pdo->beginTransaction();
        try {
            $orderId = Order::create($userId, $name, $phone, $email, $address, $comment);

            foreach ($userProducts as $userProduct) {
                $product = $products[$userProduct->getId()];
                $productId = $userProduct->getProductId();
                $quantity = $userProduct->getQuantity();
                $total = $product->getPrice() * $userProduct->getQuantity();

                OrderItem::create($orderId, $productId, $quantity, $total);
            }
            $this->pdo->commit();

            return true;
        } catch (Throwable $exception) {
            $this->pdo->rollBack();
            LoggerService::error($exception);

            require_once "./../View/500.html";
        }
        return false;
    }
}