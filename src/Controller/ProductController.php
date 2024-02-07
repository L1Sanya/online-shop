<?php
namespace Controller;
use JetBrains\PhpStorm\NoReturn;
use Model\Product;
use Model\UserProduct;
use Service\Service;
use Request\Request;
use Service\SessionAutenticationInterface;

class ProductController
{
    public function getCatalog(): void
    {
        SessionAutenticationInterface::check();
        $userId = $_SESSION['user_id'];
        $quantity = 0;

        $products = Product::getAll();

        require_once './../View/catalog.phtml';

    }
    public function getCartProducts(): void
    {
        SessionAutenticationInterface::check();
        $userId = $_SESSION['user_id'];

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
    #[NoReturn] public function plus(Request $request): void
    {
        SessionAutenticationInterface::check();
        $productId = $_POST['product-id'];
        $userId = $_SESSION['user_id'];

        $product = UserProduct::getUserProductInfo($productId, $userId);
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
    #[NoReturn] public function minus(Request $request): void
    {
        SessionAutenticationInterface::check();
        $productId = $_POST['product-id'];
        $userId = $_SESSION['user_id'];

        $product = UserProduct::getUserProductInfo($productId, $userId);
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

        $productInCartInfo = userProduct::getUserProductInfo($productId, $userId);
        if (empty($productInCartInfo)) {
            return 0;
        } else {
            return $productInCartInfo->getQuantity();
        }
    }
    #[NoReturn] public function removeProductFromCart(): void
    {
        $userId = $_POST['user-id'];
        $productId = $_POST['product-id'];

        UserProduct::deleteProduct($productId, $userId);

        Service::redirect('/cart');
    }

}
