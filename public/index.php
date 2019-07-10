<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

require __DIR__ . "/../framework/src/bootstrap.php";

$sapi = php_sapi_name();
switch ($sapi) {
    case "cli":
        require ROOT . "/app/Routes/cmd.php";
        break;
    default:
        require ROOT . "/app/Routes/web.php";
        break;
}