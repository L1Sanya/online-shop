<?php

require_once "./../Autoloader.php";
require_once "./../App.php";
Autoloader::registrate();
$app = new App();
require_once "./../Routes/ExistingRoutes.php";
$app->run();




