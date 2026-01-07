<?php
declare(strict_types=1);

use App\Core\Router;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../config/config.php";

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$router = new Router();
$router->run();