<?php

declare(strict_types=1);

namespace Leap;

/** An HTTP Microframework for PHP */
final class Leap
{
    /**
     * @param array<string> $data application configuration data
     */
    public function __construct(private readonly array $config)
    {
    }

    /** Boot the current application with its routes. */
    public function boot(callable $callback)
    {
        if (array_key_exists('REQUEST_URI', $_SERVER) && array_key_exists('REQUEST_METHOD', $_SERVER)) {
            // TODO: Proper error handling
            $file   = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1)[0]['file'];
            $config = [
                ...$this->config,
                'app_dir' => dirname($file),
            ];
            $callback(new Route($config));
        }
    }
}
