<?php

declare(strict_types=1);

namespace Leap;

/** Define application routes. */
interface RoutesInterface
{
    /** Configure application routes. */
    public static function setup(Route $route);
}
