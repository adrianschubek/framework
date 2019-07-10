<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Middleware;

use Closure;
use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;

interface MiddlewareInterface
{
    function process(RequestInterface $request, ResponseInterface $response);
//    function process(): bool;
}