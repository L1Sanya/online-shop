<?php
namespace Controller;
use JetBrains\PhpStorm\NoReturn;
use Model\Product;
use Model\UserProduct;
use Request\MinusProductRequest;
use Request\PlusProductRequest;
use Request\RemoveProductRequest;
use Service\AuthenticationInterface;
use Service\Service;
use Request\Request;
use Service\SessionAuthenticationService;

class ProductController
{
    private SessionAuthenticationService $sessionAutenticationService;
    public function __construct(SessionAuthenticationService $sessionAutenticationService)
    {
        $this->sessionAutenticationService = $sessionAutenticationService;
    }
    public function getCatalog(): void
    {
        $this->checkSession();
        $userId = $this->sessionAutenticationService->getCurrentUser()->getId();
        $quantity = 0;

        $products = Product::getAll();

        require_once './../View/catalog.phtml';

    }
    public function getCartProducts(): void
    {
        $this->checkSession();
        $userId = $this->sessionAutenticationService->getCurrentUser()->getId();

        $cart = UserProduct::getCart($userId);
        $total = 0;

        if (!empty($cart)) {
            foreach ($cart as $productInCart) {
                $productId = $productInCart->getProductId();
                $productInfo = Product::getOneById($productId);
                $productsInfo[] = $productInfo;
            }
        }
        require_once './../View/cart.phtml';

    }
    #[NoReturn] public function plus(PlusProductRequest $request): void
    {
        $this->checkSession();
        $userId = $this->sessionAutenticationService->getCurrentUser()->getId();
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
        Service::redirect('/main');
    }
    #[NoReturn] public function minus(MinusProductRequest $request): void
    {
        $this->checkSession();
        $userId = $this->sessionAutenticationService->getCurrentUser()->getId();
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
        Service::redirect('/main');
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
    #[NoReturn] public function removeProductFromCart(RemoveProductRequest $request): void
    {
        $userId = $request->getUserId();
        $productId = $request->getProductId();

        UserProduct::deleteProduct($productId, $userId);

        Service::redirect('/cart');
    }
    public function checkSession(): void
    {
        $result = $this->sessionAutenticationService->check();

        if (!$result) {
            Service::redirect("/login");
        }
    }

}
