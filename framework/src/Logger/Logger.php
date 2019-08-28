<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Logger;

/**
 * Logger Klasse
 * @package Framework\Logger
 */
abstract class Logger
{
    use Loggable;

    abstract public function log(string $type, string $content, \DateTime $time = null);

    abstract public function none(string $content, \DateTime $time = null);

    abstract public function info(string $content, \DateTime $time = null);

    abstract public function warn(string $content, \DateTime $time = null);

    abstract public function error(string $content, \DateTime $time = null);

    abstract public function event(string $content, \DateTime $time = null);

    abstract public function debug(string $content, \DateTime $time = null);
}