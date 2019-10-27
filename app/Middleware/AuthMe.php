<?php

namespace App\Middleware;

use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;
use Framework\Middleware\Middleware;

class AuthMe extends Middleware
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    function process(RequestInterface &$request, ResponseInterface &$response): bool
    {

    }
}