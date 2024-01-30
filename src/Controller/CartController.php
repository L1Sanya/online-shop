<?php

namespace Controller;

class CartController
{
    public function getCart() : void{
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
        } else {
            require_once './../View/cart.phtml';
        }
    }
    public function addToCart() : void{

    }
}