<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

// 1. Autoloader
require_once __DIR__ . "/../../vendor/autoload.php";

use Framework\Core\Application;
use Framework\Core\ConfigLoader;
use Framework\Database\Database;
use Framework\Database\Schema;

// 2. Einstellungen laden
(new ConfigLoader())->load(["app", "database", "debug", "session", "custom"]);

// 3. Dependency Injection Container erstellen
$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->useAnnotations(true);
$containerBuilder->useAutowiring(true);
if (!cfg("debug")) {
    $containerBuilder->enableCompilation(ROOT . cfg("cache.container"));
    $containerBuilder->writeProxiesToFile(true, ROOT . cfg("cache.container.proxy"));
}
$containerBuilder->addDefinitions(ROOT . "/framework/src/Core/definitions.php");

$container = $containerBuilder->build();
Schema::$db = $container->get(Database::class);

$app = new Application();
$container->set(Application::class, $app);
Application::setContainer($container);

// Nur in DEVELOPMENT (app.env === "dev")
if (cfg("app.env") === "dev") {
    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    \Kint\Renderer\RichRenderer::$theme = 'aante-light.css';
}