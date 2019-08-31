<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

use Framework\Facades\Router\Router;

Router::group("web", [
    //...  Middleware
]);

Router::get("/", "HomeController@page");

Router::get("/test", "TestController")->group("web");

Router::get("/x/[eins]", function ($eins) {
//    dd($eins, $x);
    return implode(",,, ", func_get_args());
})->name("yy");

Router::get("/x/[eins]/[zwei]", function ($eins, $zwei) {
//    dd($eins, $x);
    return implode(", ", func_get_args());
})->name("xx");

Router::post("/test", "TestController@xx");

Router::get("/b", function () {
    return Router::route("xx", ["eins" => 49, "zwei" => "abc"]);
});

Router::get("/hallo", function () {
    return "Hallo";
})->name("hallo");

//$q = "/test/[action]/xx/lol";
////$q = "/test/xx/lol";
//$str = preg_quote($q, '/');
//$str = str_replace("\]", "]", $str);
//$str = str_replace("/\\", "/", $str);
//$str2 = preg_replace("/\[([a-z]+)\]/", "([a-z0-9_-]+)", $str);

//dd($q, $str, $str2);

//$text = '[This] is a [test] string, [eat] my [shorts].';
//preg_match_all("/\[([^\]]*)\]/", $text, $matches);

Router::error(function () {
    return "404";
});

//dd($matches[1]);
//dd(app(\Framework\Router\Router::class));
//dd(Router::getRoutes());

Router::dispatch();