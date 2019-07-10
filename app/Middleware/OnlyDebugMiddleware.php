<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace App\Middleware;

use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;
use Framework\Middleware\MiddlewareInterface;

class OnlyDebugMiddleware implements MiddlewareInterface
{
    public function process(RequestInterface $request, ResponseInterface $response)
    {
        $response->setBody("");
        $response->send();

        if (cfg("debug")) return $response;
        return $response->setBody("Abgelehnt");
//        return $response = $next($request);
    }
//
//    public function process(): bool
//    {
//        return !!cfg("debug");
//    }
}