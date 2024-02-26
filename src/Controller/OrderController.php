<?php

namespace Controller;

use Core\src\AuthenticationServiceInterface;
use Core\src\ViewRenderer;
use Model\Product;
use Model\UserProduct;
use Request\PlaceOrderRequest;
use Service\OrderService;
use Throwable;
use Traits\ControllerTrait;

class OrderController
{
    use ControllerTrait;
    private OrderService $orderService;

    public function __construct(AuthenticationServiceInterface $authenticationService, OrderService $orderService, ViewRenderer $viewRenderer)
    {
        $this->authenticationService = $authenticationService;
        $this->viewRenderer = $viewRenderer;
        $this->orderService = $orderService;
    }

    public function getOrderForm(): string
    {
        $this->checkSession();

        $user = $this->authenticationService->getCurrentUser();
        if (!$user) {
            header('Location: /login');
        }

        $userId = $user->getId();
        $userProducts = UserProduct::getCartProductsByUserId($userId);
        $products = Product::getProducts($userId);

        return $this->viewRenderer->render('order.phtml', [
                'userProducts' => $userProducts,
                'products' => $products,
            ], true
        );
    }

    /**
     * @throws Throwable
     */
    public function orderForm(PlaceOrderRequest $request): string
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
                $result = $this->orderService->create($userId, $request->getName(), $request->getPhone(), $request->getEmail(), $request->getAddress(), $request->getComment());
                if ($result) {
                    header('Location: /main');
                }
                return $this->viewRenderer->render('500.html', [], false);
            } else {
                header('Location: /cart');
            }
        } else {
            $products = Product::getProducts($userId);
            }
        return $this->viewRenderer->render('order.phtml', [
                'userProducts' => $userProducts,
                'products' => $products,
            ], true
        );
    }


    private function checkSession(): void
    {
        $result = $this->authenticationService->check();

        if (!$result) {
            header('Location: /login');
        }
    }
}