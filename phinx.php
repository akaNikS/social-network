<?php

$container = require __DIR__ . '/src/bootstrap.php';

/** @var App\Services\DataBase\MySql\MySql $mySql */
$mySql = $container->get(\App\Services\DataBase\MySql\MySql::class);

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'production',
        'production' => [
            'name' => 'sms_service',
            'connection' => $mySql->getPDO(),
        ],
    ],
    'version_order' => 'creation'
];
