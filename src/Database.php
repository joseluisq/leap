<?php

declare(strict_types=1);

namespace Leap;

use Illuminate\Database\Capsule\Manager as Capsule;

/** `Leap` database class. */
final class Database
{
    private static ?Capsule $capsule = null;

    /** Initialize the application database and returns a single instance. */
    public static function init(array $config): Capsule
    {
        if (static::$capsule == null) {
            static::$capsule = new Capsule();
            static::$capsule->addConnection($config);
            static::$capsule->setAsGlobal();
            static::$capsule->bootEloquent();
        }

        return static::$capsule;
    }
}
