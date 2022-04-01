<?php

declare(strict_types=1);

namespace Leap;

use Twig\Environment as TwigEnvironment;
use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;

abstract class Controller
{
    /** @param TwigEnvironment View */
    private TwigEnvironment $view;

    // TODO: provide a configuration object instead
    public function __construct(string $view_dir, string $cache_dir)
    {
        $loader     = new TwigFilesystemLoader($view_dir);
        $this->view = new TwigEnvironment($loader, [
            'cache' => $cache_dir,
        ]);
    }

    public function render(string $view_file, array $data = []): string
    {
        return $this->view->render($view_file, $data);
    }
}
