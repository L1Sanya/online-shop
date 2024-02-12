<?php

namespace Model;

class OrderItem extends Model
{
    protected ?int $id;
    protected ?int $orderId;
    protected ?int $productId;
    protected ?int $quantity;
    protected ?int $totalPrice;

    public function __construct(?int $id = null, ?int $orderId = null, ?int $productId = null, ?int $quantity = null, ?int $totalPrice = null)
    {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->totalPrice = $totalPrice;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }
}