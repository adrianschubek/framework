<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Logger;


trait Loggable
{
    /** Soll diese Methode mit Level X geloggt werden?
     * @param int $level Methodenlevel
     * @return bool
     */
    protected function shouldLog(int $level)
    {
        return cfg("debug.logger.level") >= $level;
    }

    protected function log(string $content)
    {

    }
}