<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

// 1. Autoloader
require_once __DIR__ . "/../../vendor/autoload.php";
spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    if (strpos($className, "Framework") !== false) {
        $className = str_replace("Framework\\", "", $className);
        require_once __DIR__ . '..' . DIRECTORY_SEPARATOR . $className . '.php';
    } else {
        $className = str_replace("App\\", "", $className);
        require_once __DIR__ . "/../../app/" . $className . '.php';
    }
});

use Framework\Core\Autoloader;
use Framework\Core\ConfigLoader;

// 2. Helper PHP Dateien laden
$autoloader = new Autoloader(__DIR__ . DIRECTORY_SEPARATOR);
$autoloader->load(["Utility\common"]);

// 3. Einstellungen laden
$cfgloader = new ConfigLoader();
$cfgloader->load(["app", "database", "debug", "session", "custom"]);

// 4. Dependency Injection Container erstellen
$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->useAnnotations(false);
$containerBuilder->useAutowiring(true);
if (!cfg("debug")) {
    $containerBuilder->enableCompilation(ROOT . cfg("cache.container"));
    $containerBuilder->writeProxiesToFile(true, ROOT . cfg("cache.container.proxy"));
}
$containerBuilder->addDefinitions(ROOT . "/framework/src/Core/definitions.php");

$container = $containerBuilder->build();