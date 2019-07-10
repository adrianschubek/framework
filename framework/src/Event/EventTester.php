<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Event;

require_once __DIR__ . "/../bootstrap.php";

$eventmanager = EventManager::getEventManager();
$eventmanager->add(new EventListener("debug.test1", function ($args) {
    echo "okay " . implode(" ", $args);
}));

$eventmanager->trigger("debug.test1", ["xx"]);