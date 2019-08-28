<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

require __DIR__ . "/../framework/src/bootstrap.php";

$sapi = php_sapi_name();
if ($sapi === "cli") {
    if (cfg("debug")) {
        require ROOT . "/framework/src/cli.php";
    }
    require ROOT . "/app/Routes/cmd.php";
} else {
    require ROOT . "/app/Routes/web.php";
}