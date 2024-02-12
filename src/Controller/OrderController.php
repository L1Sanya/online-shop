<?php

namespace Controller;

use Model\Product;
use Model\UserProduct;
use Request\PlaceOrderRequest;
use Service\SessionAuthenticationService;

class OrderController
{
    private SessionAuthenticationService $sessionAuthenticationService;

    public function __construct(SessionAuthenticationService $sessionAuthenticationService)
    {
        $this->sessionAuthenticationService = $sessionAuthenticationService;
    }

    public function getOrderForm(): void
    {
        $this->checkSession();

        $userId = $this->sessionAuthenticationService->getCurrentUser()->getId();
        $userProducts = UserProduct::getCart($userId);

        require_once './../View/order.phtml';
    }

    public function OrderFrom(PlaceOrderRequest $request): void
    {

    }


    private function checkSession(): void
    {
        $result = $this->sessionAuthenticationService->check();

        if (!$result) {
            header('Location: /login');
        }
    }

}