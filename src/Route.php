<?php

declare(strict_types=1);

namespace Leap;

/** `Leap` HTTP routing class. */
final class Route
{
    /**
     * @param array<string> $data additional data that will be passed to Ruta callback(s)
     */
    public function __construct(private readonly array $data = [])
    {
    }

    /**
     * It handles requests based on the HTTP `GET` method.
     *
     * @param string                 $path                 URI
     * @param callable|array<string> $class_method_or_func Class method string array or callable
     */
    public function get(string $path, callable|array $class_method_or_func): void
    {
        \Ruta\Ruta::get($path, $class_method_or_func, $this->data);
    }

    /**
     * It handles requests based on the HTTP `HEAD` method.
     *
     * @param string                 $path                 URI
     * @param callable|array<string> $class_method_or_func Class method string array or callable
     */
    public function head(string $path, callable|array $class_method_or_func): void
    {
        \Ruta\Ruta::head($path, $class_method_or_func, $this->data);
    }

    /**
     * It handles requests based on the HTTP `POST` method.
     *
     * @param string                 $path                 URI
     * @param callable|array<string> $class_method_or_func Class method string array or callable
     */
    public function post(string $path, callable|array $class_method_or_func): void
    {
        \Ruta\Ruta::post($path, $class_method_or_func, $this->data);
    }

    /**
     * It handles requests based on the HTTP `PUT` method.
     *
     * @param string                 $path                 URI
     * @param callable|array<string> $class_method_or_func Class method string array or callable
     */
    public function put(string $path, callable|array $class_method_or_func): void
    {
        \Ruta\Ruta::put($path, $class_method_or_func, $this->data);
    }

    /**
     * It handles requests based on the HTTP `DELETE` method.
     *
     * @param string                 $path                 URI
     * @param callable|array<string> $class_method_or_func Class method string array or callable
     */
    public function delete(string $path, callable|array $class_method_or_func): void
    {
        \Ruta\Ruta::delete($path, $class_method_or_func, $this->data);
    }

    /**
     * It handles requests based on the HTTP `CONNECT` method.
     *
     * @param string                 $path                 URI
     * @param callable|array<string> $class_method_or_func Class method string array or callable
     */
    public function connect(string $path, callable|array $class_method_or_func): void
    {
        \Ruta\Ruta::connect($path, $class_method_or_func, $this->data);
    }

    /**
     * It handles requests based on the HTTP `OPTIONS` method.
     *
     * @param string                 $path                 URI
     * @param callable|array<string> $class_method_or_func Class method string array or callable
     */
    public function options(string $path, callable|array $class_method_or_func): void
    {
        \Ruta\Ruta::options($path, $class_method_or_func, $this->data);
    }

    /**
     * It handles requests based on the HTTP `TRACE` method.
     *
     * @param string                 $path                 URI
     * @param callable|array<string> $class_method_or_func Class method string array or callable
     */
    public function trace(string $path, callable|array $class_method_or_func): void
    {
        \Ruta\Ruta::trace($path, $class_method_or_func, $this->data);
    }

    /**
     * It handles requests based on the HTTP `PATCH` method.
     *
     * @param string                 $path                 URI
     * @param callable|array<string> $class_method_or_func Class method string array or callable
     */
    public function patch(string $path, callable|array $class_method_or_func): void
    {
        \Ruta\Ruta::patch($path, $class_method_or_func, $this->data);
    }

    /**
     * It handles requests based a set of valid HTTP methods.
     *
     * @param array<string>          $methods
     * @param string                 $path                 URI
     * @param callable|array<string> $class_method_or_func Class method string array or callable
     */
    public function some(string $path, array $methods, callable|array $class_method_or_func): void
    {
        \Ruta\Ruta::some($path, $methods, $class_method_or_func, $this->data);
    }

    /**
     * It handles requests based on all valid HTTP methods.
     *
     * @param string                 $path                 URI
     * @param callable|array<string> $class_method_or_func Class method string array or callable
     */
    public function any(string $path, callable|array $class_method_or_func): void
    {
        \Ruta\Ruta::any($path, $class_method_or_func, $this->data);
    }

    /**
     * It handles all `404` not found routes.
     *
     * @param \Closure|array<string> $class_method_or_func
     */
    public function not_found(\Closure|array $class_method_or_func): void
    {
        \Ruta\Ruta::not_found($class_method_or_func, $this->data);
    }
}
