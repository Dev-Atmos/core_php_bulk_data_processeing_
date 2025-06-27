<?php

namespace App\Helpers;

class Logger
{
    const LOG_PATH = BASE_PATH . '/logs/';

    public static function info(string $message, string $file = 'app.log')
    {
        self::write('INFO', $message, $file);
    }

    public static function error(string $message, string $file = 'error.log')
    {
        self::write('ERROR', $message, $file);
    }

    public static function debug(string $message, string $file = 'debug.log')
    {
        self::write('DEBUG', $message, $file);
    }

    public static function custom(string $type, string $message, string $file = 'app.log')
    {
        self::write(strtoupper($type), $message, $file);
    }

    private static function write(string $level, string $message, string $file)
    {
        if (!is_dir(self::LOG_PATH)) {
            mkdir(self::LOG_PATH, 0777, true);
        }

        $timestamp = date('[Y-m-d H:i:s]');
        $line = "$timestamp [$level] $message" . PHP_EOL;
        file_put_contents(self::LOG_PATH . $file, $line, FILE_APPEND);
    }
}
