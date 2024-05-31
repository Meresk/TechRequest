<?php
//./vendor/bin/pint for refactor in console

// Глобальная константа для удобного перехода по каталогам (/app и из него в любой каталог)
define('APP_PATH', dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';

use App\Kernel\App;

$app = new App;

$app->run();
