<?php

use Core\App;
use Core\Autoloader;
use Core\Container\Container;
use Controller\CartController;
use Controller\OrderController;
use Controller\ProductController;
use Controller\UserController;
use Service\Authentication\AuthenticationServiceInterface;
use Service\Authentication\SessionAuthenticationService;
use Service\OrderService;

$container = new Container();

$container->set(AuthenticationServiceInterface::class, function () {
    return new SessionAuthenticationService();
});

$container->set(OrderService::class, function () {
    return new OrderService();
});

$container->set(UserController::class, function (Container $container) {
    $authenticationService = $container->get(AuthenticationServiceInterface::class);

    return new UserController($authenticationService);
});

$container->set(ProductController::class, function (Container $container) {
    $authenticationService = $container->get(AuthenticationServiceInterface::class);

    return new ProductController($authenticationService);
});

$container->set(CartController::class, function (Container $container) {
    $authenticationService = $container->get(AuthenticationServiceInterface::class);

    return new CartController($authenticationService);
});

$container->set(OrderController::class, function (Container $container) {
    $authenticationService = $container->get(AuthenticationServiceInterface::class);
    $orderService = $container->get(OrderService::class);

    return new OrderController($authenticationService, $orderService);
});

require_once "./../Core/Autoloader.php";
require_once "./../Core/App.php";

Autoloader::registrate();

$app = new App($container);

require_once "./../Routes/ExistingRoutes.php";
$app->run();





