<?php

namespace App;

use Request\Request;
use Service\Authentication\AuthenticationServiceInterface;
use Service\Authentication\SessionAuthenticationService;
use Service\CartService;
use Service\OrderService;


class App
{
    private array $routes = [];

    public function get(string $url, string $class, string $handler, string $request = null): void
    {
        $this->routes[$url]['GET'] = [
            'class' => $class,
            'method' => $handler,
            'request' => $request
        ];
    }

    public function post(string $url, string $class, string $handler, string $request = null): void
    {
        $this->routes[$url]['POST'] = [
            'class' => $class,
            'method' => $handler,
            'request' => $request
        ];
    }

    public function run(): void
    {

        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$requestUri])) {
            $routeMethods = $this->routes[$requestUri];
            if (isset($routeMethods[$requestMethod])) {
                $handler = $routeMethods[$requestMethod];

                $class = $handler['class'];
                $method = $handler['method'];
                $request = $handler['request'];

                $service = new SessionAuthenticationService();
                $orderService = new OrderService();

                $obj = new $class($service, $orderService);

                if (isset($request)) {
                    $request = new $handler['request']($requestMethod, $requestUri, headers_list(), $_REQUEST);
                } else {
                    $request = new Request($requestMethod, $requestUri, headers_list(), $_REQUEST);
                }
                $obj->$method($request);

            } else {
                echo "Метод $requestMethod не поддерживается для адреса $requestUri";
            }
        } else {
            require_once './../View/404.html';
        }
    }

}