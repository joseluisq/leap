<?php

declare(strict_types=1);

namespace Leap;

use Illuminate\Database\Capsule\Manager as Capsule;

/** `Leap` database class. */
final class Database
{
    private static ?Capsule $capsule = null;

    /** Get an application database instance. */
    public static function conn(array $config): Capsule
    {
        if (self::$capsule == null) {
            self::$capsule = new Capsule();
            self::$capsule->addConnection($config);
            self::$capsule->setAsGlobal();
            self::$capsule->bootEloquent();
        }

        return self::$capsule;
    }
}
