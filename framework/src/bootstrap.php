<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */
define("ROOT", __DIR__ . "/../../");
define("FRAMEWORK_START", microtime(true));

//TODO: Cleanup

// 1. Autoloader
require_once __DIR__ . "/../../vendor/autoload.php";

use Framework\Config\Config;
use Framework\Core\Application;
use Framework\Core\ConfigLoader;
use Framework\Core\Providers\CoreServiceProvider;
use Framework\Core\ServiceProvider;

//set_exception_handler(function (Exception $exception) {
//    echo get_class($exception) . $exception->getFile() . " -- " . $exception->getLine();
//});

// 2. Confirguration
$cfgLoader = new ConfigLoader();
$cfgLoader->load(["app", "database", "debug", "session", "custom"]);
if (cfg("cache")) {
    $path = __DIR__ . "/../../app/Cache/Config/cfg.json";
    if (!file_exists($path)) {
        file_put_contents($path, json(Config::getArray()));
    }
    Config::setArray(toArray(file_get_contents($path)));
}

// 3. Dependency Injection Container
$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->useAnnotations(true);
if (cfg("cache")) {
    $containerBuilder->enableCompilation(ROOT . cfg("cache.container"));
    $containerBuilder->writeProxiesToFile(true, ROOT . cfg("cache.container.proxy"));
}
$dotenv = Dotenv\Dotenv::create(ROOT);
$dotenv->load();
(new CoreServiceProvider())->boot();
foreach (cfg("providers") as $provider) {
    (new $provider())->boot();
}
$containerBuilder->addDefinitions(ServiceProvider::getServices());
$container = $containerBuilder->build();

$app = new Application();
$container->set(Application::class, $app);
Application::setContainer($container);

// DEVELOPMENT (app.env === "dev")
if (cfg("app.env") === "dev") {
    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    \Kint\Renderer\RichRenderer::$theme = 'aante-light.css';
}