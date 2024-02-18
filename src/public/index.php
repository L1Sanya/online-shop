<?php

use App\App;
use App\Autoloader;

require_once "./../App/Autoloader.php";
require_once "./../App/App.php";
Autoloader::registrate();
$app = new App();
require_once "./../Routes/ExistingRoutes.php";
$app->run();





