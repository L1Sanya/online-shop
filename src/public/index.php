<?php

use l1sanya\MyCore\App;
use l1sanya\MyCore\Autoloader;

require_once "./../Core/Autoloader.php";

Autoloader::registrate();

include "./../Config/Services.php";

$app = new App($container);

require_once "./../Routes/ExistingRoutes.php";

$app->run();





