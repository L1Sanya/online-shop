<?php

namespace Controller;

use Model\Product;
use Model\UserProduct;
use Request\PlaceOrderRequest;
use Service\Authentication\AuthenticationServiceInterface;
use Service\OrderService;
use Throwable;

class OrderController
{
    private AuthenticationServiceInterface $authenticationService;
    private OrderService $orderService;

    public function __construct(AuthenticationServiceInterface $authenticationService, OrderService $orderService)
    {
        $this->authenticationService = $authenticationService;
        $this->orderService = $orderService;
    }

    public function getOrderForm(): void
    {
        $this->checkSession();

        $user = $this->authenticationService->getCurrentUser();
        if (!$user) {
            header('Location: /login');
        }

        $userId = $user->getId();
        $userProducts = UserProduct::getCartProductsByUserId($userId);
        $products = Product::getProducts($userId);

        require_once './../View/order.phtml';
    }

    /**
     * @throws Throwable
     */
    public function orderForm(PlaceOrderRequest $request): void
    {
        $this->checkSession();

        $user = $this->authenticationService->getCurrentUser();
        if (!$user) {
            header('Location: /login');
        }

        $userId = $user->getId();
        $errors = $request->validate();
        $userProducts = UserProduct::getCartProductsByUserId($userId);

        if (empty($errors)) {
            if (!empty($userProducts)) {
                $this->orderService->create($userId, $request->getName(), $request->getPhone(), $request->getEmail(), $request->getAddress(), $request->getComment());

                header('Location: /main');
            } else {
                header('Location: /cart');
            }
        } else {
            $products = Product::getProducts($userId);

            require_once './../View/order.phtml';
        }
    }

    private function checkSession(): void
    {
        $result = $this->authenticationService->check();

        if (!$result) {
            header('Location: /login');
        }
    }
}