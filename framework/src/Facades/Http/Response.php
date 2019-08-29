<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Facades\Http;


use Framework\Http\ResponseInterface;
use Framework\Support\Facade;

class Response extends Facade
{
    protected static $name = ResponseInterface::class;
}