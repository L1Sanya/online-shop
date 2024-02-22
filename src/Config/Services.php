<?php

use Core\Container\Container;
use Controller\CartController;
use Controller\OrderController;
use Controller\ProductController;
use Controller\UserController;
use Core\ViewRenderer;
use Service\Authentication\AuthenticationServiceInterface;
use Service\Authentication\SessionAuthenticationService;
use Service\OrderService;

$container = new Container();

$container->set(AuthenticationServiceInterface::class, function () {
    return new SessionAuthenticationService();
});

$container->set(UserController::class, function (Container $container) {
    $authenticationService = $container->get(AuthenticationServiceInterface::class);
    $viewRenderer = $container->get(ViewRenderer::class);

    return new UserController($authenticationService, $viewRenderer);
});

$container->set(ProductController::class, function (Container $container) {
    $authenticationService = $container->get(AuthenticationServiceInterface::class);
    $viewRenderer = $container->get(ViewRenderer::class);

    return new ProductController($authenticationService, $viewRenderer);
});

$container->set(OrderController::class, function (Container $container) {
    $authenticationService = $container->get(AuthenticationServiceInterface::class);
    $orderService = $container->get(OrderService::class);
    $viewRenderer = $container->get(ViewRenderer::class);

    return new OrderController($authenticationService, $orderService, $viewRenderer);
});

$container->set(CartController::class, function (Container $container) {
    $authenticationService = $container->get(AuthenticationServiceInterface::class);
    $viewRenderer = $container->get(ViewRenderer::class);

    return new CartController($authenticationService, $viewRenderer);
});

$container->set(OrderService::class, function (Container $container) {
    $pdo = $container->get(PDO::class);
    return new OrderService($pdo);
});

$container->set(PDO::class, function () {
    $host = getenv('DB_HOST');
    $dbname = getenv('DB_DATABASE');
    $username= getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    $port = getenv('DB_PORT');
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    return new PDO("pgsql:host=$host; port=$port; dbname=$dbname", $username, $password, $options);
});