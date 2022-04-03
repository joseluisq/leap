<?php

declare(strict_types=1);

namespace Leap;

final class Leap
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        return $this;
    }

    public function boot(callable $routes)
    {
        $routes($this->config);
    }
}
