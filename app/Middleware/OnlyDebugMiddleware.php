<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace App\Middleware;

use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;
use Framework\Middleware\Middleware;

class OnlyDebugMiddleware extends Middleware
{
    public $type = self::BEFORE;

    public function process(RequestInterface &$request, ResponseInterface &$response): bool
    {
        if (cfg("debug")) {
            return true;
        }
        $response->statusCode(401);
        $response->body("Abgelehnt");
        return false;
    }
}