<?php
namespace Controller;
use JetBrains\PhpStorm\NoReturn;
use Model\Product;
use Model\UserProduct;
use Service\Service;
use Request\Request;

class ProductController
{

    public function getCatalog(): void {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            Service::redirect('Location: /login');
        } else {
            $userId = $_SESSION['user_id'];
            $quantity = 0;

            $products = Product::getAll();
            $productsCount = $this->countProducts($userId);

            require_once './../View/catalog.phtml';
        }
    }
    public function countProducts($userId): int
    {
        $cart = UserProduct::getCart($userId);
        if ($cart === null) {
            return 0;
        }
        return count($cart);
    }


    public function getCartProducts(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            Service::redirect('/login');
        } else {
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
    }
    #[NoReturn] public function plus(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            Service::redirect('/login');
        }
        $productId = $_POST['product-id'];
        $userId = $_SESSION['user_id'];

        $product = UserProduct::getProductInCartInfo($productId, $userId);
        if (isset($product)) {
            $product->setQuantity($product->getQuantity() + 1);
            $quantity = $product->getQuantity();
            $product->save($quantity, $productId, $userId);
        } else {
            $quantity = 1;
            UserProduct::create($userId, $productId, $quantity);
        }
        Service::redirect('/main');
    }
    #[NoReturn] public function minus(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            Service::redirect('login');
        }
        $productId = $_POST['product-id'];
        $userId = $_SESSION['user_id'];

        $product = UserProduct::getProductInCartInfo($productId, $userId);
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

        $productInCartInfo = userProduct::getProductInCartInfo($productId, $userId);
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