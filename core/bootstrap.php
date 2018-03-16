<?php

define("DS",DIRECTORY_SEPARATOR);
$routes = require_once __DIR__ .DS."..".DS."app".DS."routes.php";

$route = new \Core\Route($routes);



