<?php

require_once "./../App/Autoloader.php";
require_once "./../App.php";
Autoloader::registrate();

$app = new App();
$app->run();




