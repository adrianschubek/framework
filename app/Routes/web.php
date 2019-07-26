<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

use App\Controllers;
use App\Middleware;
use FastRoute\RouteCollector;

//Router::add('GET', '/cache', [Controllers\TestController::class, 'show']);

$dispatcher = FastRoute\cachedDispatcher(function (RouteCollector $r) {

    $r->addRoute('GET', '/listener', [Controllers\ListenerController::class, 'show']);
    $r->addRoute('GET', '/', [Controllers\HomeController::class, 'page',
        [Middleware\OnlyDebugMiddleware::class]
    ]);
    $r->addRoute('GET', '/test', [Controllers\TestController::class, 'test']);
    $r->addRoute('GET', '/add/{x:[0-9]+}/{y:[0-9]+}', [Controllers\TestController::class, 'add']);
    $r->addRoute('GET', '/cache', [Controllers\CacheTestController::class, 'show']);
    $r->addRoute('GET', '/func', [Controllers\CacheTestController::class, 'allFunc']);
    $r->addRoute('GET', '/clear', [Controllers\CacheTestController::class, 'clearCache']);

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
//            foreach ($arr as $type => $middleware) {
//                foreach ($middleware as $m) {
//                    $container->call([$controller[0], "registerMiddleware"], [
//                        new $m, $type
//                    ]);
//                }
//            }

            foreach ($arr as $middleware) {
                $container->call([$controller[0], "registerMiddleware"], [new $middleware]);
            }

            $container->call([$controller[0], "runBefore"]);
            unset($controller[2]);
        }
        $container->call($controller, $parameters);
        $container->call([$controller[0], "finally"]);
        break;
}