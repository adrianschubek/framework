<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

use Framework\Facades\Router;

Router::group("web", [
    //...  Middleware
]);

Router::get("/", "HomeController@page")->middleware("avc");

Router::get("/test", "");
//dd(app(\Framework\Router\Router::class));
dd(Router::getRoutes());