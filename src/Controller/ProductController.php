<?php
namespace Controller;
use Model\Product;
use Model\UserProduct;
use Traits\ControllerTrait;

class ProductController
{
    use ControllerTrait;


    public function getCatalog(): string
    {
        if (!$this->authenticationService->check()) {
            header('Location: /login');
        }

        $user = $this->authenticationService->getCurrentUser();
        if (!$user) {
            header('Location: /login');
        }

        $userId = $user->getId();
        $products = Product::getAll();
        $productsCount = UserProduct::getCount($userId);

        return $this->viewRenderer->render('catalog.phtml', [
            'user' => $user,
            'products' => $products,
            'productsCount' => $productsCount,
                ], true
        );
    }

}
