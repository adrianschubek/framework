<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

return [
    "debug" => true,

    "debug.logger" => Framework\Logger\FileLoggerFactory::class,

    /** Logger Level: 0 = nichts, 5 = alles (Methodenaufrufe) */
    "debug.logger.level" => 5,
];