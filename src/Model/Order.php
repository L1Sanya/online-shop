<?php

namespace Model;

use DateTime;

class Order extends Model
{
    protected ?int $id;
    protected ?int $userId;
    protected ?int $totalAmount;
    protected ?string $address;
    protected ?string $phone;
    protected DateTime $orderDate;
    protected ?string $status;

    public function __construct(?int $id, ?int $userId, ?int $totalAmount, DateTime $orderDate, ?string $status)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->totalAmount = $totalAmount;
        $this->orderDate = $orderDate;
        $this->status = $status;
    }

    public  function getAddress(): ?string
    {
        return $this->address;
    }

    public  function getPhone(): ?string
    {
        return $this->phone;
    }

    public  function getId(): ?int
    {
        return $this->id;
    }

    public  function getUserId(): ?int
    {
        return $this->userId;
    }

    public  function getTotalAmount(): ?int
    {
        return $this->totalAmount;
    }

    public  function getOrderDate(): DateTime
    {
        return $this->orderDate;
    }

    public  function getStatus(): ?string
    {
        return $this->status;
    }
}