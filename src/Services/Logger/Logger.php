<?php
namespace App\Services\Logger;

use Psr\Log\LogLevel;

class Logger implements \Psr\Log\LoggerInterface
{
    private string $name;
    public function __construct(string $name = 'log')
    {
        $this->name = $name;
    }

    public function emergency($message, array $context = array())
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = array())
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = array())
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = array())
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = array())
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = array())
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = array())
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = array())
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    public function log($level, $message, array $context = array())
    {
        $log = date('Y-m-d H:m:s') . '[' . getmypid() . ']' . '[' . $level . ']' . $message .
            ($context ? "\n" . implode("\n", $context) : '') . "\n";

        if (PHP_SAPI === 'cli') {
            echo $log;
        }
        file_put_contents(__DIR__ . '/../../../logs/' . $this->name . '.log', $log, FILE_APPEND);
    }
}