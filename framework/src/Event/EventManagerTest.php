<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Event;
require_once __DIR__ . "/EventManager.php";
require_once __DIR__ . "/Event.php";

use PHPUnit\Framework\TestCase;

class EventManagerTest extends TestCase
{
    public function testTrigger()
    {
        $eventmanager = EventManager::getEventManager();
        $eventmanager->add(new EventListener("debug.test1", function ($args) {
            echo "okay " . implode(" ", $args);
        }));

        $eventmanager->trigger("debug.test1", ["xx"]);

        $this->expectOutputString("okay xx");
    }
}
