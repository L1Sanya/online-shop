<?php
use Controller\ProductController;
use Controller\UserController;
use Service\SessionAuthenticationService;

$app->get('/login', UserController::class, 'getLogin');
$app->post('/login', UserController::class, 'postLogin', \Request\LoginRequest::class);

$app->get('/registrate', UserController::class, 'getRegistrate');
$app->post('/registrate',UserController::class,'postRegistrate', \Request\RegistrationRequest::class);

$app->get('/logout', SessionAuthenticationService::class, 'logout');
$app->get('/main', ProductController::class,'getCatalog');

$app->get('/cart', ProductController::class, 'getCartProducts');
$app->post('/product-plus', ProductController::class, 'plus');
$app->post('/product-minus', ProductController::class, 'minus');
$app->post('/remove-product', ProductController::class, 'removeProductFromCart');