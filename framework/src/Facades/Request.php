<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Facades;


use Framework\Http\RequestInterface;
use Framework\Support\Facade;

class Request extends Facade
{
    protected static $name = RequestInterface::class;
}