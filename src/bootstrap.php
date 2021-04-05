<?php

use App\Services\DataBase\MySql\MySql;
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../vendor/autoload.php';

\App\App\ErrorHandlers::init();

$builder = new DI\ContainerBuilder();
$builder->addDefinitions(__DIR__ .  '/../configs/mysql.php');
$builder->addDefinitions(__DIR__ . '/../configs/crypto.php');
$builder->addDefinitions([
    \Smarty::class => function() {
        $smarty = new \Smarty();
        $smarty->setTemplateDir(__DIR__ . '/../templates');
        $smarty->setCompileDir(__DIR__ . '/../templates_c');
        return $smarty;
    },
    MySql::class => function (ContainerInterface $c) {
        return new MySql((array) $c->get('mysql'));
    },
    \Psr\Log\LoggerInterface::class => new App\Services\Logger\Logger('log'),
    App\Services\Crypto\Crypto::class => function (ContainerInterface $c) {
        return new App\Services\Crypto\Crypto((string) $c->get('salt'));
    },
]);

/*$builder->addDefinitions([
    \App\Services\User\UserService::class => function (ContainerInterface $c) {
        return new \App\Services\User\UserService($c->get(MySql::class));
    },
]);*/
return $builder->build();
