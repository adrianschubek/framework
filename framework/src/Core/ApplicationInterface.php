<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Core;


use Framework\Http\ResponseInterface;
use Psr\Container\ContainerInterface;

interface ApplicationInterface
{
    static function container();

    static function setContainer(ContainerInterface $container);

    function send(ResponseInterface $response);
}