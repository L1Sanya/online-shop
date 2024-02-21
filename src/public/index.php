<?php

use Core\App;
use Core\Autoloader;

require_once "./../Core/Autoloader.php";

Autoloader::registrate();

include "./../Config/Services.php";

$app = new App($container);

require_once "./../Routes/ExistingRoutes.php";

$app->run();





