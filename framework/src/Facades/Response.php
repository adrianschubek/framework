<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Facades;


use Framework\Support\Facade;

class Response extends Facade
{
    protected static $name = \Framework\Http\ResponseInterface::class;
}