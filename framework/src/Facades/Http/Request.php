<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Facades\Http;

use Framework\Http\RequestInterface;
use Framework\Support\Facade;

class Request extends Facade
{
    protected static $name = RequestInterface::class;
}