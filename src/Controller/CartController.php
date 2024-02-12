<?php

namespace Controller;

use JetBrains\PhpStorm\NoReturn;
use Model\Product;
use Model\UserProduct;
use Request\RemoveProductRequest;
use Service\SessionAuthenticationService;

class CartController
{
    private SessionAuthenticationService $sessionAuthenticationService;

    public function __construct(SessionAuthenticationService $sessionAuthenticationService)
    {
        $this->sessionAuthenticationService = $sessionAuthenticationService;
    }

    #[NoReturn] public function removeProductFromCart(RemoveProductRequest $request): void
    {
        $userId = $request->getUserId();
        $productId = $request->getProductId();

        UserProduct::deleteProduct($productId, $userId);

        header('Location: /cart');
    }

    public function getCartProducts(): void
    {
        $this->checkSession();

        $userId = $this->sessionAuthenticationService->getCurrentUser()->getId();
        $userProducts = UserProduct::getCart($userId);

        if (!empty($userProducts)) {
            foreach ($userProducts as $userProduct) {
                $productIds[] = $userProduct->getProductId();
            }

            $products = Product::getAllByIds($productIds);
        }
        require_once './../View/cart.phtml';

    }

    public function getProductQuantity($productInfo): ?int
    {
        $productId = $productInfo->getId();
        $userId = $_SESSION['user_id'];
        $productInCart = userProduct::getUserProduct($productId, $userId);

        if (empty($productInCart)) {
            return 0;
        } else {
            return $productInCart->getQuantity();
        }
    }

    private function checkSession(): void
    {
        $result = $this->sessionAuthenticationService->check();

        if (!$result) {
            header('Location: /login');
        }
    }
}