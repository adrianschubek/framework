<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Core;

use DI\Container;
use Framework\Facades\Http\Response;
use Framework\Http\ResponseInterface;
use Psr\Container\ContainerInterface;

class Application implements ApplicationInterface
{
    /**
     * DI Container
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
        if ($response) { // Custom response returned
            $response->send();
        }
        Response::send();
    }
}