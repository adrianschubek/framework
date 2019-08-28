<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Core;

use Framework\Config\Config;
use Framework\Config\ConfigInterface;
use Framework\Event\EventManager as Events;
use Framework\Exception\ConfigNotFound;

class ConfigLoader
{
    private $config;

    public function __construct(ConfigInterface $config = null)
    {
        $this->config = $config ?? Config::class;
    }

    /** Lädt eine oder mehrere Config aus dem App\Config Ordner
     * Bei $silent
     * @param array $configName
     * @param bool $silent = true
     * @throws ConfigNotFound
     */
    public function load(array $configName, bool $silent = true)
    {
        foreach ($configName as $cfg) {
            if (!file_exists(__DIR__ . "/../../../app/Config/$cfg.php")) {
                if (!$silent) {
                    throw new ConfigNotFound("Config file not found in app\Config folder");
                }
            }
            $arr = include __DIR__ . "/../../../app/Config/$cfg.php";
            Config::setArray($arr);
//            Events::getEventManager()->trigger("app.core.config.loaded", ["config" => $configName]);
        }
    }
}

//    $cf
////require_once __DIR__ . "/../bootstrap.php";
////
////EventManager::getEventManager()->add(new EventListener("app.core.config.loaded", function ($args) {
////    echo sprintf("%s erfolgreich geladen.", $args["config"]);
////}));
//////TODO: Mache "UserCOntroller#register" als Callable akzeptiert statt function(..)...
////EventManager::getEventManager()->add(new EventListener("app.core.config.loaded", function ($args) {
////    echo sprintf("%s erfolgreich geladen.", $args["config"]);
////}));
////
////$cfgloader = new ConfigLoader();
////try {gloader->load(["app"]);
//} catch (ConfigNotFound $e) {
//}
