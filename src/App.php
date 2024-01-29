<?php

use Controller\UserController as UserController;
use Controller\ProductController as ProductController;
class App
{
    public function run(){

        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestUri === '/login') {

            if ($requestMethod === 'GET') {
                $obj = new UserController();
                $obj->getLogin();
            } elseif ($requestMethod === 'POST') {
                $obj = new UserController();
                $obj->postLogin();
            } else {
                echo "Метод $requestMethod не поддерживается для адреса $requestUri";
            }

        } elseif ($requestUri === '/registrate') {

            if ($requestMethod === 'GET') {
                $obj = new UserController();
                $obj->getRegistrate();
            } elseif ($requestMethod === 'POST') {
                $obj = new UserController();
                $obj->postRegistrate();
            } else {
                echo "Метод $requestMethod не поддерживается для адреса $requestUri";
            }

        } elseif ($requestUri === '/main') {

            $obj = new ProductController();
            $obj->getCatalog();
        } elseif ($requestUri === '/logout') {

            $obj = new UserController();
            $obj->logout();

        } elseif ($requestUri === '/add-product') {

            $obj = new ProductController();
            $obj->addProduct();

        } elseif ($requestUri === '/cart') {

            $obj = new ProductController();
            $obj->getCart();
        }

        else {
            require_once './../View/404.html';
        }
    }
}