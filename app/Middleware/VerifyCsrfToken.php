<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace App\Middleware;


use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;
use Framework\Middleware\Middleware;

class VerifyCsrfToken extends Middleware
{

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    function process(RequestInterface &$request, ResponseInterface &$response): bool
    {

    }
}