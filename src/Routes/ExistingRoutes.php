<?php
use Controller\ProductController;
use Controller\UserController;
use Service\Service;

require_once "./../Autoloader.php";
require_once "./../App.php";

Autoloader::registrate();
$app = new App();
$app->get('/login', UserController::class, 'getLogin');
$app->post('/login', UserController::class, 'postLogin');

$app->get('/registrate', UserController::class, 'getRegistrate');
$app->post('/registrate', UserController::class, 'postRegistrate');

$app->get('/logout', Service::class, 'logout');
$app->get('/main', ProductController::class,'getCatalog');

$app->get('/cart', ProductController::class, 'getCartProducts');
$app->post('/product-plus', ProductController::class, 'plus');
$app->post('/product-minus', ProductController::class, 'minus');
$app->post('/remove-product', ProductController::class, 'removeProductFromCart');
$app->run();