<?php
use Controller\ProductController;
use Controller\UserController;

require_once "./../Autoloader.php";
require_once "./../App.php";

Autoloader::registrate();
$app = new App();
$app->get('/main', ProductController::class,'getCatalog');

$app->get('/login', UserController::class, 'getLogin');
$app->post('/login', UserController::class, 'postLogin');

$app->get('/registrate', UserController::class, 'getRegistrate');
$app->post('/registrate', UserController::class, 'postRegistrate');

$app->get('/logout', UserController::class, 'logout');

$app->get('/cart', ProductController::class, 'getCartProducts');
$app->post('/product-plus', ProductController::class, 'plus');
$app->post('/product-minus', ProductController::class, 'minus');
$app->post('/remove-product', ProductController::class, 'removeProductFromCart');
$app->run();