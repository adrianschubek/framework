<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

use App\Middleware\OnlyDebugMiddleware;
use Framework\Facades\Router;

Router::group("web", [
    //...  Middleware
]);

Router::get("/", "HomeController@page")->middleware([OnlyDebugMiddleware::class, OnlyDebugMiddleware::class]);

Router::get("/test", "")->middleware("web");

Router::get("/x/[data]", "")->name("xx");

Router::post("/test", "TestController@xx");

$q = "/test/[action]/xx/lol";
//$q = "/test/xx/lol";
$str = preg_quote($q, '/');
$str = str_replace("\]", "]", $str);
$str = str_replace("/\\", "/", $str);
$str2 = preg_replace("/\[([a-z]+)\]/", "([a-z0-9_-]+)", $str);

//dd($q, $str, $str2);

$text = '[This] is a [test] string, [eat] my [shorts].';
preg_match_all("/\[([^\]]*)\]/", $text, $matches);

Router::error(function () {

});

//dd($matches[1]);
//dd(app(\Framework\Router\Router::class));
//dd(Router::getRoutes());

Router::dispatch();