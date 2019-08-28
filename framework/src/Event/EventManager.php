<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Event;


class EventManager
{
    /**
     * @var EventManager
     */
    private static $singleton = null;

    /** Liste der Events
     * @var EventListener[][] $events
     */
    private $events;

    private function __construct()
    {
    }

    /**
     * @return EventManager
     */
    public static function getEventManager()
    {
        if (self::$singleton === null) {
            self::$singleton = new EventManager();
        }
        return self::$singleton;
    }

    /** Erstellt ein neues Event
     * @param EventListener $event
     */
    public function add(EventListener $event)
    {
        $this->events[$event->getName()][] = $event;
    }

    /** Löst ein Event aus
     * @param string $eventname
     * @param array|null $args
     */
    public function trigger(string $eventname, array $args = null)
    {
        if (isset($this->events[$eventname])) {
            foreach ($this->events[$eventname] as $event) {
                if (is_callable($event->getCallback())) {
                    call_user_func($event->getCallback(), $args);
                }
            }
        }
    }
}
