<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Middleware;

use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;

abstract class Middleware
{
    public const BEFORE = "before";
    public const AFTER = "after";

    /** Typ der Middleware:
     * "BEFORE" oder "AFTER"
     * @var string
     */
    public $type = self::BEFORE;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    abstract function process(RequestInterface &$request, ResponseInterface &$response): bool;
}