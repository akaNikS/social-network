<?php
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../vendor/autoload.php';

\App\App\ErrorHandlers::init();

$builder = new DI\ContainerBuilder();
$builder->addDefinitions(__DIR__ .  '/../configs/mysql.php');
$builder->addDefinitions([
    \Smarty::class => function() {
        $smarty = new \Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../templates');
        $smarty->setCompileDir(__DIR__ . '/../templates_c');
        return $smarty;
    },
    \App\DataBase\MySql\MySql::class => function (ContainerInterface $c) {
        return new \App\DataBase\MySql\MySql((array) $c->get('mysql'));
    },
    \Psr\Log\LoggerInterface::class => new App\Services\Logger\Logger('log')
]);
return $builder->build();
