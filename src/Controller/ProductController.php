<?php
namespace Controller;
use JetBrains\PhpStorm\NoReturn;
use Model\Product;
use Model\UserProduct;
use Request\MinusProductRequest;
use Request\PlusProductRequest;
use Service\SessionAuthenticationService;

class ProductController
{
    private SessionAuthenticationService $sessionAuthenticationService;

    public function __construct(SessionAuthenticationService $sessionAuthenticationService)
    {
        $this->sessionAuthenticationService = $sessionAuthenticationService;
    }

    public function getCatalog(): void
    {
        $this->checkSession();

        $userId = $this->sessionAuthenticationService->getCurrentUser()->getId();
        $quantity = 0;
        $products = Product::getAll();

        require_once './../View/catalog.phtml';

    }

    #[NoReturn] public function plus(PlusProductRequest $request): void
    {
        $this->checkSession();

        $userId = $this->sessionAuthenticationService->getCurrentUser()->getId();
        $productId = $request->getId();
        $product = UserProduct::getUserProduct($productId, $userId);

        if (isset($product)) {
            $product->setQuantity($product->getQuantity() + 1);
            $quantity = $product->getQuantity();
            $product->save($quantity, $productId, $userId);
        } else {
            $quantity = 1;

            UserProduct::createProductInCart($userId, $productId, $quantity);
        }
        header('Location: /main');
    }

    #[NoReturn] public function minus(MinusProductRequest $request): void
    {
        $this->checkSession();

        $userId = $this->sessionAuthenticationService->getCurrentUser()->getId();
        $productId = $request->getId();
        $product = UserProduct::getUserProduct($productId, $userId);

        if (isset($product)) {
            $product->setQuantity($product->getQuantity() - 1);

            if ($product->getQuantity() < 1) {
                UserProduct::deleteProduct($productId, $userId);
            } else {
                $quantity = $product->getQuantity();
                $product->save($quantity, $productId, $userId);
            }
        }
        header('Location: /main');
    }

    public function checkSession(): void
    {
        $result = $this->sessionAuthenticationService->check();

        if (!$result) {
            header('Location: /login');
        }
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

}
