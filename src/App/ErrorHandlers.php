<?php
namespace App\App;

class ErrorHandlers
{
    public static function init(): void
    {
        set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline) {
            $globalErrors = new \App\Services\Logger\Logger('global_errors');
            $backTrace = debug_backtrace();
            array_shift($backTrace);
            $globalErrors->error(
                $errstr . ' in file: ' . $errfile . ' on line ' . $errline,
                array_map(function ($e) {
                    return 'file: ' . $e['file'] . ' on line ' . $e['line'];
                }, $backTrace)
            );
        });

        set_exception_handler(function (\Throwable $exception) {
            $globalExceptions = new \App\Services\Logger\Logger('global_exceptions');
            $globalExceptions->error(
                $exception->getMessage() . ' in file: ' . $exception->getFile() . ' on line ' . $exception->getLine(),
                [$exception->getTraceAsString()]
            );
        });
    }
}
