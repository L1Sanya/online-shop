<?php

use Controller\CartController;
use Controller\OrderController;
use Controller\ProductController;
use Controller\UserController;
use Request\PlaceOrderRequest;

$app->get('/login', UserController::class, 'getLogin');
$app->post('/login', UserController::class, 'login', \Request\LoginRequest::class);

$app->get('/registration', UserController::class, 'getRegistration');
$app->post('/registration',UserController::class,'registration', \Request\RegistrationRequest::class);

$app->post('/logout', UserController::class, 'logout');

$app->get('/main', ProductController::class,'getCatalog');
$app->post('/product-plus', ProductController::class, 'plus');
$app->post('/product-minus', ProductController::class, 'minus');

$app->get('/cart', CartController::class, 'getCartProducts');
$app->post('/remove-product', CartController::class, 'removeProductFromCart');

$app->get('/order', OrderController::class, 'getOrderForm');
$app->post('/order', OrderController::class, 'orderForm', PlaceOrderRequest::class);



$app->get('/api/users', \Controller\Api\UserController::class, 'index');