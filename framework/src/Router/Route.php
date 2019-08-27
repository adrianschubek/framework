<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Router;


class Route
{
    /**
     * @var string
     */
    protected $method;
    /**
     * @var string
     */
    protected $route;
    protected $controller;
    protected $middleware;
    protected $middlewareGroup;

    public function __construct(string $method, string $route, $controller)
    {
        $this->method = $method;
        $this->route = $route;
        $this->controller = $controller;
    }

    public function middleware($middleware)
    {
        if (is_string($middleware)) {
            $this->middlewareGroup = $middleware;
            return;
        }
        if (is_array($middleware)) {
            $this->middleware[] = $middleware;
        }
    }

    public function name(string $name)
    {

    }
}