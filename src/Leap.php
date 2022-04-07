<?php

declare(strict_types=1);

namespace Leap;

/** An HTTP Microframework for PHP */
final class Leap
{
    /**
     * @param array<string> $data Application configuration data.
     */
    public function __construct(private readonly array $config)
    {
    }

    /** Boot the current application with its routes. */
    public function boot(callable $callback)
    {
        $callback(new Route($this->config));
    }
}
