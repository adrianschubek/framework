<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

use App\Controllers;
use App\Middleware;
use FastRoute\RouteCollector;

$dispatcher = FastRoute\cachedDispatcher(function (RouteCollector $r) {

    $r->addRoute('GET', '/listener', [Controllers\ListenerController::class, 'show']);
    $r->addRoute('GET', '/', [Controllers\HomeController::class, 'page', [
        "before" => [
            Middleware\OnlyDebugMiddleware::class
        ],
    ]]);
    $r->addRoute('GET', '/test', [Controllers\TestController::class, 'test']);

//    $r->addRoute('GET', '/assets/{path:.+}', [Controllers\AssetsController::class, 'loadAssets']);

}, [
    'cacheFile' => ROOT . cfg("cache.router"),
    'cacheDisabled' => !cfg("cache")
]);

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        $container->call([Controllers\ErrorController::class, "notFound"], [$_SERVER['REQUEST_URI']]);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $container->call([Controllers\ErrorController::class, "notAllowed"], [$_SERVER['REQUEST_URI']]);
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];
        if (isset($controller[2])) {
            $arr = $controller[2];
            foreach ($arr as $type => $middleware) {
                foreach ($middleware as $m) {
                    $container->call([$controller[0], "registerMiddleware"], [
                        new $m, $type
                    ]);
                }
            }
            $container->call([$controller[0], "runBefore"]);
            unset($controller[2]);
        }
//        die(json($container->call([])));
        $container->call($controller, $parameters);
        $container->call([$controller[0], "runAfter"]);
        $container->call([$controller[0], "finally"]);
        break;
}