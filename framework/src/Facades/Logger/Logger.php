<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Facades\Logger;


use DateTime;
use Framework\Support\Facade;

/**
 * Class Logger
 * @package Framework\Facades
 * @method static log(string $type, string $content, DateTime $time = null)
 * @method static none(string $content, DateTime $time = null)
 * @method static info(string $content, DateTime $time = null)
 * @method static warn(string $content, DateTime $time = null)
 * @method static error(string $content, DateTime $time = null)
 * @method static event(string $content, DateTime $time = null)
 * @method static debug(string $content, DateTime $time = null)
 */
class Logger extends Facade
{
    protected static $name = \Framework\Logger\Logger::class;
}