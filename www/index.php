<?php

use App\Routing\Routing;

$container = require __DIR__ . '/../src/bootstrap.php';
session_start();
$app = \DI\Bridge\Slim\Bridge::create($container);

Routing::init($app);
$app->run();
