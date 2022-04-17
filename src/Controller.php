<?php

declare(strict_types=1);

namespace Leap;

use Illuminate\Database\Capsule\Manager as Capsule;
use Monolog\Logger as MonologLogger;
use Twig\Environment as TwigEnvironment;
use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;

if (!function_exists('is_absolute_path')) {
    // https://github.com/symfony/symfony/blob/6.1/src/Symfony/Component/Filesystem/Path.php#L364
    function is_absolute_path(string $path): bool
    {
        if ('' === $path) {
            return false;
        }

        // Strip scheme
        if (false !== ($schemeSeparatorPosition = mb_strpos($path, '://'))) {
            $path = mb_substr($path, $schemeSeparatorPosition + 3);
        }

        $firstCharacter = $path[0];

        // UNIX root "/" or "\" (Windows style)
        if ('/' === $firstCharacter || '\\' === $firstCharacter) {
            return true;
        }

        // Windows root
        if (mb_strlen($path) > 1 && ctype_alpha($firstCharacter) && ':' === $path[1]) {
            // Special case: "C:"
            if (2 === mb_strlen($path)) {
                return true;
            }

            // Normal case: "C:/ or "C:\"
            if ('/' === $path[2] || '\\' === $path[2]) {
                return true;
            }
        }

        return false;
    }
}

/** `Leap` base controller class to be extended by other controllers. */
class Controller
{
    /** @param array Contains route data passed */
    public array $route_data = [];

    /** @param ?TwigEnvironment View */
    private ?TwigEnvironment $_view = null;

    /** @param ?Capsule Database reference */
    private ?Capsule $_db = null;

    public function initilize()
    {
        // TODO: Proper error handling
        $app_dir     = $this->route_data['app_dir'];
        $view_dir    = $this->route_data['views']['views_dir'];
        $cache_dir   = $this->route_data['views']['cache_dir'];
        $view_dir    = is_absolute_path($view_dir)
            ? $view_dir : str_replace('//', '', "$app_dir/$view_dir");
        $cache_dir   = is_absolute_path($cache_dir)
            ? $cache_dir : str_replace('//', '', "$app_dir/$cache_dir");

        $loader      = new TwigFilesystemLoader($view_dir);
        $this->_view = new TwigEnvironment($loader, [
            'cache' => $cache_dir,
        ]);

        $this->log()->debug("Views directory configured at \"$view_dir\"");
        $this->log()->debug("Cache directory configured at \"$cache_dir\"");

        $this->db();
    }

    /** It returns a single `Illuminate` database manager instance. */
    public function db(): Capsule
    {
        if ($this->_db === null) {
            // TODO: Proper error handling
            $app_dir     = $this->route_data['app_dir'];
            $driver      = $this->route_data['database']['driver'];
            $database    = $this->route_data['database']['database'];

            $this->log()->debug("Using database \"$driver\" driver");

            if ($driver === 'sqlite') {
                $database = is_absolute_path($database)
                    ? $database : str_replace('//', '', "$app_dir/$database");
            }

            $config = [
                ...$this->route_data['database'],
                'database' => $database,
            ];

            $this->_db = Database::init($config);
            $this->log()->debug('Database connection initialized');
        }

        return $this->_db;
    }

    /** It returns a single logger instance. */
    public function log(): MonologLogger
    {
        // TODO: Proper error handling
        return Logger::init($this->route_data['app_dir'], $this->route_data['logger']);
    }

    /** Render a view with an specific data. */
    public function render(string $view_file, array $data = []): string
    {
        if ($this->_view === null) {
            $this->initilize();
        }

        return $this->_view->render($view_file, $data);
    }
}
