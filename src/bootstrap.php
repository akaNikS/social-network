<?php
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../vendor/autoload.php';

set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline) {
    $globalErrors = new App\Services\Logger\Logger('global_errors');
    $backTrace = debug_backtrace();
    array_shift($backTrace);
    $globalErrors->error(
        $errstr . ' in file: ' . $errfile . ' on line ' . $errline,
        array_map(function ($e) {
            return 'file: ' . $e['file'] . ' on line ' . $e['line'];
        }, $backTrace)
    );
});
//todo implementation
set_exception_handler(function () {

});

$builder = new DI\ContainerBuilder();
$builder->addDefinitions(__DIR__ .  '/../configs/mysql.php');
$builder->addDefinitions([
    \Slim\Views\PhpRenderer::class => new \Slim\Views\PhpRenderer('../templates/'),
    \App\DataBase\MySql\MySql::class => function (ContainerInterface $c) {
        return new \App\DataBase\MySql\MySql((array) $c->get('mysql'));
    },
]);
return $builder->build();
