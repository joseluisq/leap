<?php

declare(strict_types=1);

namespace Leap;

/** Define application settings. */
interface ConfigInterface
{
    /**
     * Get all application settings loaded from the system environment variables.
     * NOTE: relative-path values are relative to the app root directory.
     */
    public static function get(): array;
}
