<?php

$container = require __DIR__ . '/../../../src/bootstrap.php';

$logger = new \App\Services\Logger\Logger();
$logger->info('start');

for ($i = 0; $i < 5000; $i++) {
    $logger->info('task № ' . $i . ' started');
    if (random_int(0, 100) > 95) {
        $logger->error('Error');
    }
    $logger->info('task № ' . $i . ' completed');
}

$secondLogger = new App\Services\Logger\Logger('second_log');

$secondLogger->warning('Test warning');