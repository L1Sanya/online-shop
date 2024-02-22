<?php

namespace Controller;

use Core\ViewRenderer;
use Model\Product;
use Model\UserProduct;
use Request\MinusProductRequest;
use Request\PlusProductRequest;
use Request\RemoveProductRequest;
use Service\Authentication\AuthenticationServiceInterface;
use Traits\ControllerTrait;

class CartController
{
    use ControllerTrait;


    public function getCartProducts(): array|string
    {
        $this->checkSession();

        $user = $this->authenticationService->getCurrentUser();
        if (!$user) {
            header('Location: /login');
        }

        $userId = $user->getId();
        $userProducts = UserProduct::getCartProductsByUserId($userId);

        $products = Product::getProducts($userId);

        return $this->viewRenderer->render('cart.phtml', [
                'user' => $user,
                'userProducts' => $userProducts,
                'products' => $products
            ], true
        );
    }

    public function plus(PlusProductRequest $request): void
    {
        $this->checkSession();

        $user = $this->authenticationService->getCurrentUser();
        if (!$user) {
            header('Location: /login');
        }

        $userProduct = UserProduct::getUserProduct($request->getId(), $user->getId());
        if (isset($userProduct)) {
            $userProduct->incrementQuantity();
        } else {
            UserProduct::create($user->getId(), $request->getId(), 1);
        }

        header('Location: /main');
    }

    public function minus(MinusProductRequest $request): void
    {
        $this->checkSession();

        $user = $this->authenticationService->getCurrentUser();
        if (!$user) {
            header('Location: /login');
        }

        $userProduct = UserProduct::getUserProduct($request->getId(), $user->getId());
        $userProduct->decrementQuantity();

        header('Location: /main');
    }

    public function removeProductFromCart(RemoveProductRequest $request): void
    {
        $userProduct = UserProduct::getUserProduct($request->getProductId(), $request->getUserId());
        $userProduct->destroy();

        header('Location: /cart');
    }

    private function checkSession(): void
    {
        $result = $this->authenticationService->check();

        if (!$result) {
            header('Location: /login');
        }

    }
}