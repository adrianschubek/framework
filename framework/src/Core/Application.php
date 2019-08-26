<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Core;

use DI\Container;
use Framework\Http\ResponseInterface;
use Psr\Container\ContainerInterface;

class Application implements ApplicationInterface
{
    /**
     * @var Container
     */
    protected static $container;

    public static function container()
    {
        return self::$container;
    }

    public static function setContainer(ContainerInterface $container)
    {
        self::$container = $container;
    }

    public function send(?ResponseInterface $response)
    {
        $response->send();
    }
}