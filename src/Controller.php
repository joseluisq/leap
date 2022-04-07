<?php

declare(strict_types=1);

namespace Leap;

use Twig\Environment as TwigEnvironment;
use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;

/** `Leap` base controller class to be extended by other controllers. */
class Controller
{
    /** @param array Contains route data passed */
    public array $route_data = [];

    /** @param ?TwigEnvironment View */
    private ?TwigEnvironment $view = null;

    public function initilize()
    {
        // TODO: proper error handling
        $loader     = new TwigFilesystemLoader($this->route_data['views']['views_dir']);
        $this->view = new TwigEnvironment($loader, [
            'cache' => $this->route_data['views']['cache_dir'],
        ]);
    }

    public function render(string $view_file, array $data = []): string
    {
        if ($this->view === null) {
            $this->initilize();
        }

        return $this->view->render($view_file, $data);
    }
}
