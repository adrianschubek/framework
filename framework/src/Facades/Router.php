<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Facades;


use Framework\Router\Route;
use Framework\Support\Facade;

/**
 * Class Router
 * @package Framework\Facades
 *
 * @method static Route get(string $routePath, $controller)
 * @method static Route post(string $routePath, $controller)
 * @method static Route put(string $routePath, $controller)
 * @method static Route delete(string $routePath, $controller)
 * @method static group(string $name, array $middleware)
 * @method static dispatch($method = null, $uri = null)
 * @method static error($controller)
 * @method static array getRoutes()
 */
class Router extends Facade
{
    protected static $name = \Framework\Router\Router::class;
}