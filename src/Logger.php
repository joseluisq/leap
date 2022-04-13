<?php

declare(strict_types=1);

namespace Leap;

use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;

/** `Leap` logging class. */
final class Logger
{
    private static ?MonologLogger $logger = null;

    /** Get an application logger instance. */
    public static function init(string $app_dir, array $config): MonologLogger
    {
        if (self::$logger == null) {
            $level       = match ($config['level']) {
                'DEBUG'     => MonologLogger::DEBUG,
                'INFO'      => MonologLogger::INFO,
                'NOTICE'    => MonologLogger::NOTICE,
                'WARNING'   => MonologLogger::WARNING,
                'ERROR'     => MonologLogger::ERROR,
                'CRITICAL'  => MonologLogger::CRITICAL,
                'ALERT'     => MonologLogger::ALERT,
                'EMERGENCY' => MonologLogger::EMERGENCY,
                default     => MonologLogger::ERROR,
            };
            $logfile = $config['path'];
            $logfile = is_absolute_path($logfile)
                ? $logfile : str_replace('//', '', "$app_dir/$logfile");
            self::$logger = new MonologLogger($config['name']);
            self::$logger->pushHandler(new StreamHandler($logfile, $level));
        }

        return self::$logger;
    }
}
