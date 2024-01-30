<?php

use Controller\ProductController;

require_once "./../App/Autoloader.php";
require_once "./../App.php";
Autoloader::registrate();

//$rout = new Controller\RoutController();
//$rout->addRoute('/main','GET', 'ProductController::class','getCatalog');

$app = new App();
$app->addRoute('/main','GET', ProductController::class,'getCatalog');
$app->run();




