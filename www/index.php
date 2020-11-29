<?php

use App\Routing\Routing;
use Psr\Container\ContainerInterface;

require '../vendor/autoload.php';

$builder = new DI\ContainerBuilder();
$builder->addDefinitions("../configs/mysql.php");
$builder->addDefinitions([
    \Slim\Views\PhpRenderer::class => new \Slim\Views\PhpRenderer('../templates/'),
    \App\DataBase\MySql\MySql::class => function (ContainerInterface $c) {
        return new \App\DataBase\MySql\MySql((array) $c->get('mysql'));
    },
]);
$container = $builder->build();
$app = \DI\Bridge\Slim\Bridge::create($container);

Routing::init($app);
$app->run();
