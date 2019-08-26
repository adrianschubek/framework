<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

use Framework\Config\Config;
use Framework\Core\Application;

/** Helper Funktionen und Shortcuts für häufig verwendete Methoden **/

/** Konstanten */
if (Config::has("dir.frmwrk")) {
    define("FRAMEWORK_DIR", Config::get("dir.frmwrk"));
}
if (Config::has("app.ds")) {
    define("DS", Config::get("app.ds"));
}

/** Funktionen */
if (!function_exists("view")) {
    /**
     * @param string $view
     * @param array $data
     */
    function view(string $view, array $data)
    {
        Framework\View\View::render($view, $data);
    }
}

if (!function_exists("cfg")) {
    /** Liest oder setzt eine Einstellung
     * @param string $key
     * @param $data
     * @return mixed
     */
    function cfg(string $key, $data = null)
    {
        if ($data !== null) {
            Config::set($key, $data);
        }
        return Config::get($key);
    }
}

if (!function_exists("nonce")) {
    function nonce($length = 16, $hex = true)
    {
        return Framework\Security\Nonce::generate($length, $hex);
    }
}

if (!function_exists("redirect")) {
    function redirect(string $route)
    {
        header("Location: $route");
    }
}

if (!function_exists("app")) {
    function app(string $name)
    {
        return Application::container()->get($name);
    }
}

if (!function_exists("abort")) {
    function abort(int $code)
    {

    }
}

if (!function_exists("call")) {
    function call(callable $callable, array $params)
    {
        return Application::container()->call($callable, $params);
    }
}

if (!function_exists("__")) {
    function __()
    {

    }
}

if (!function_exists("toLower")) {
    function toLower(string &$str)
    {
        $str = mb_strtolower($str);
    }
}

if (!function_exists("toUpper")) {
    function toUpper(string &$str)
    {
        $str = mb_strtoupper($str);
    }
}

if (!function_exists("filter")) {
    function filter(&$data)
    {
        Framework\Security\Filter::filterString($data);
    }
}

if (!function_exists("event")) {
    function event(string $name, array $args = null)
    {
        Framework\Event\EventManager::getEventManager()->trigger($name, $args);
    }
}

if (!function_exists("json")) {
    function json($data, $prettyPrint = false)
    {
        return ($prettyPrint) ? json_encode($data, JSON_PRETTY_PRINT) : json_encode($data);
    }
}

if (!function_exists("toArray")) {
    function toArray($data)
    {
        return json_decode($data, true);
    }
}

if (!function_exists("response")) {
    function response()
    {

    }
}