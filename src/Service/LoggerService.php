<?php

namespace Service;

class LoggerService
{
    const string filepath = './../Storage/Logs/';

    public static function error(string $message): void
    {
        $file = self::filepath . 'errors.txt';
        $log = '[' . date('Y-m-d H:i:s') . '] [ERROR] ' . $message . PHP_EOL;
        file_put_contents($file, $log, FILE_APPEND | LOCK_EX);
    }

    public static function info(string $message): void
    {
        $file = self::filepath . 'info.txt';
        $log = '[' . date('Y-m-d H:i:s') . '] [INFO] ' . $message . PHP_EOL;
        file_put_contents($file, $log, FILE_APPEND | LOCK_EX);
    }
}