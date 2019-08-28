<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Utility;


class Stopwatch
{
    private $start;

    public function start()
    {
        $this->start = microtime(true);
    }

    public function stop(): float
    {
        return microtime(true) - $this->start;
    }
}