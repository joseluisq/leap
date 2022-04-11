<?php

declare(strict_types=1);

namespace Leap;

use Twig\Environment as TwigEnvironment;
use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;
use Illuminate\Database\Capsule\Manager as Capsule;

/** `Leap` base controller class to be extended by other controllers. */
class Controller
{
    /** @param array Contains route data passed */
    public array $route_data = [];

    /** @param ?TwigEnvironment View */
    private ?TwigEnvironment $_view = null;

    public function initilize()
    {
        // TODO: proper error handling
        $loader     = new TwigFilesystemLoader($this->route_data['views']['views_dir']);
        $this->_view = new TwigEnvironment($loader, [
            'cache' => $this->route_data['views']['cache_dir'],
        ]);
    }

    /** It returns a single database manager instance. */
    public function db(): Capsule
    {
        // TODO: proper error handling
        return Database::conn($this->route_data['database']);
    }

    public function render(string $view_file, array $data = []): string
    {
        if ($this->_view === null) {
            $this->initilize();
        }

        return $this->_view->render($view_file, $data);
    }
}
