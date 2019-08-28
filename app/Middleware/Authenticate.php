<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace App\Middleware;


use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;
use Framework\Middleware\Middleware;

class Authenticate extends Middleware
{
    public $type = self::BEFORE;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    function process(RequestInterface &$request, ResponseInterface &$response): bool
    {

    }
}