<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

/**
 * Allgemeine Einstellungen
 */
return [
    /**
     * App
     */
    "app.env" => "dev", // "dev" oder "prod"

    "app.name" => "",

    "app.author" => "Adrian Schubek",

    "app.version" => "1.0.0",

    "app.ds" => DIRECTORY_SEPARATOR,

    "app.lang" => ["de", "en"],

    "app.lang.default" => "de",
    /**
     * Ordnerpfade
     */
    /** Framework Ordner */
    "dir.frmwrk" => ROOT . "/framework/src/",

    /** App Ordner */
    "dir.app" => ROOT . "/app",

    /** Public Ordner **/
    "dir.public" => ROOT . "/public/",

    /** Logs Ordner */
    "dir.logs" => ROOT . "/app/Logs/",

    /**
     * Cache
     */
    "cache" => false,

    "cache.default" => '/app/Cache/Default',

    "cache.router" => '/app/Cache/Router/route.cache',

    "cache.templates" => '/app/Cache/Templates',

    "cache.container" => '/app/Cache/Container',

    "cache.container.proxy" => '/app/Cache/Proxy',

    /**
     * Router
     */
    "router.error.controller" => App\Controllers\ErrorController::class,

    "router.error.not_found" => "notFound",

    "router.error.method_not_allowed" => "notAllowed",
];