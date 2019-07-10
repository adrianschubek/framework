<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Logger;


interface LoggerFactoryInterface
{
    public function createLogger(): Logger;
}