<?php

declare(strict_types=1);

namespace Leap;

use \Twig\Loader\FilesystemLoader as TwigFilesystemLoader;
use \Twig\Environment as TwigEnvironment;

abstract class Controller
{
    /** @param TwigEnvironment View */
    private TwigEnvironment $view;

    public function __construct()
    {
        $loader = new TwigFilesystemLoader(__DIR__ . '/../views');
        $this->view = new TwigEnvironment($loader, [
            'cache' => __DIR__ . '/../cache',
        ]);
    }

    public function render(string $view_file, array $data = []): string
    {
        return $this->view->render($view_file, $data);
    }
}
