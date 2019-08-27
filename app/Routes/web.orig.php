<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

use App\Controllers;
use App\Middleware;
use FastRoute\RouteCollector;
use Framework\Facades\App;

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
    case FastRoute\Dispatcher::NOT_FOUND: // 404
        $response = $container->call([cfg("router.error.controller"), cfg("router.error.not_found")], [$_SERVER['REQUEST_URI']]);
        App::send($response);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED: // 405
        $response = $container->call([cfg("router.error.controller"), cfg("router.error.method_not_allowed")], [$_SERVER['REQUEST_URI']]);
        App::send($response);
        break;
    case FastRoute\Dispatcher::FOUND: // 302
        $controller = $route[1];
        $parameters = $route[2];

        if (isset($controller[2])) {
            $arr = $controller[2];
            foreach ($arr as $middleware) {
                $container->call([$controller[0], "middleware"], [new $middleware()]);
            }
            $container->call([$controller[0], "runBefore"]);
            unset($controller[2]);
        }
        $response = $container->call($controller, $parameters);

        App::send($response);
        $container->call([$controller[0], "runAfter"]);
        break;
}